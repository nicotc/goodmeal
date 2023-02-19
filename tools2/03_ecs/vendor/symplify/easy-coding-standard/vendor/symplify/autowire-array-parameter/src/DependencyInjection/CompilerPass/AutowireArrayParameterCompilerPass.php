<?php

declare (strict_types=1);
namespace ECSPrefix202211\Symplify\AutowireArrayParameter\DependencyInjection\CompilerPass;

use ECSPrefix202211\Nette\Utils\Strings;
use ReflectionClass;
use ReflectionMethod;
use ECSPrefix202211\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use ECSPrefix202211\Symfony\Component\DependencyInjection\ContainerBuilder;
use ECSPrefix202211\Symfony\Component\DependencyInjection\Definition;
use ECSPrefix202211\Symfony\Component\DependencyInjection\Reference;
use ECSPrefix202211\Symplify\AutowireArrayParameter\DependencyInjection\DefinitionFinder;
use ECSPrefix202211\Symplify\AutowireArrayParameter\DocBlock\ParamTypeDocBlockResolver;
use ECSPrefix202211\Symplify\AutowireArrayParameter\Skipper\ParameterSkipper;
use ECSPrefix202211\Symplify\AutowireArrayParameter\TypeResolver\ParameterTypeResolver;
/**
 * @inspiration https://github.com/nette/di/pull/178
 * @see \Symplify\AutowireArrayParameter\Tests\DependencyInjection\CompilerPass\AutowireArrayParameterCompilerPassTest
 */
final class AutowireArrayParameterCompilerPass implements CompilerPassInterface
{
    /**
     * These namespaces are already configured by their bundles/extensions.
     *
     * @var string[]
     */
    private const EXCLUDED_NAMESPACES = ['Doctrine', 'JMS', 'Symfony', 'Sensio', 'Knp', 'EasyCorp', 'Sonata', 'Twig'];
    /**
     * Classes that create circular dependencies
     *
     * @var string[]
     * @noRector \Rector\Privatization\Rector\Property\ChangeReadOnlyPropertyWithDefaultValueToConstantRector
     * @noRector \Rector\Php55\Rector\String_\StringClassNameToClassConstantRector
     */
    private $excludedFatalClasses = ['ECSPrefix202211\\Symfony\\Component\\Form\\FormExtensionInterface', 'ECSPrefix202211\\Symfony\\Component\\Asset\\PackageInterface', 'ECSPrefix202211\\Symfony\\Component\\Config\\Loader\\LoaderInterface', 'ECSPrefix202211\\Symfony\\Component\\VarDumper\\Dumper\\ContextProvider\\ContextProviderInterface', 'ECSPrefix202211\\EasyCorp\\Bundle\\EasyAdminBundle\\Form\\Type\\Configurator\\TypeConfiguratorInterface', 'ECSPrefix202211\\Sonata\\CoreBundle\\Model\\Adapter\\AdapterInterface', 'ECSPrefix202211\\Sonata\\Doctrine\\Adapter\\AdapterChain', 'ECSPrefix202211\\Sonata\\Twig\\Extension\\TemplateExtension', 'ECSPrefix202211\\Symfony\\Component\\HttpKernel\\KernelInterface'];
    /**
     * @var \Symplify\AutowireArrayParameter\DependencyInjection\DefinitionFinder
     */
    private $definitionFinder;
    /**
     * @var \Symplify\AutowireArrayParameter\TypeResolver\ParameterTypeResolver
     */
    private $parameterTypeResolver;
    /**
     * @var \Symplify\AutowireArrayParameter\Skipper\ParameterSkipper
     */
    private $parameterSkipper;
    /**
     * @param string[] $excludedFatalClasses
     */
    public function __construct(array $excludedFatalClasses = [])
    {
        $this->definitionFinder = new DefinitionFinder();
        $paramTypeDocBlockResolver = new ParamTypeDocBlockResolver();
        $this->parameterTypeResolver = new ParameterTypeResolver($paramTypeDocBlockResolver);
        $this->parameterSkipper = new ParameterSkipper($this->parameterTypeResolver, $excludedFatalClasses);
    }
    public function process(ContainerBuilder $containerBuilder) : void
    {
        $definitions = $containerBuilder->getDefinitions();
        foreach ($definitions as $definition) {
            if ($this->shouldSkipDefinition($containerBuilder, $definition)) {
                continue;
            }
            /** @var ReflectionClass<object> $reflectionClass */
            $reflectionClass = $containerBuilder->getReflectionClass($definition->getClass());
            /** @var ReflectionMethod $constructorReflectionMethod */
            $constructorReflectionMethod = $reflectionClass->getConstructor();
            $this->processParameters($containerBuilder, $constructorReflectionMethod, $definition);
        }
    }
    private function shouldSkipDefinition(ContainerBuilder $containerBuilder, Definition $definition) : bool
    {
        if ($definition->isAbstract()) {
            return \true;
        }
        if ($definition->getClass() === null) {
            return \true;
        }
        // here class name can be "%parameter.class%"
        $parameterBag = $containerBuilder->getParameterBag();
        $resolvedClassName = $parameterBag->resolveValue($definition->getClass());
        // skip 3rd party classes, they're autowired by own config
        $excludedNamespacePattern = '#^(' . \implode('|', self::EXCLUDED_NAMESPACES) . ')\\\\#';
        if (Strings::match($resolvedClassName, $excludedNamespacePattern)) {
            return \true;
        }
        if (\in_array($resolvedClassName, $this->excludedFatalClasses, \true)) {
            return \true;
        }
        if ($definition->getFactory()) {
            return \true;
        }
        if (!\class_exists($definition->getClass())) {
            return \true;
        }
        $reflectionClass = $containerBuilder->getReflectionClass($definition->getClass());
        if (!$reflectionClass instanceof ReflectionClass) {
            return \true;
        }
        if (!$reflectionClass->hasMethod('__construct')) {
            return \true;
        }
        /** @var ReflectionMethod $constructorReflectionMethod */
        $constructorReflectionMethod = $reflectionClass->getConstructor();
        return !$constructorReflectionMethod->getParameters();
    }
    private function processParameters(ContainerBuilder $containerBuilder, ReflectionMethod $reflectionMethod, Definition $definition) : void
    {
        $reflectionParameters = $reflectionMethod->getParameters();
        foreach ($reflectionParameters as $reflectionParameter) {
            if ($this->parameterSkipper->shouldSkipParameter($reflectionMethod, $definition, $reflectionParameter)) {
                continue;
            }
            $parameterType = $this->parameterTypeResolver->resolveParameterType($reflectionParameter->getName(), $reflectionMethod);
            if ($parameterType === null) {
                continue;
            }
            $definitionsOfType = $this->definitionFinder->findAllByType($containerBuilder, $parameterType);
            $definitionsOfType = $this->filterOutAbstractDefinitions($definitionsOfType);
            $argumentName = '$' . $reflectionParameter->getName();
            $definition->setArgument($argumentName, $this->createReferencesFromDefinitions($definitionsOfType));
        }
    }
    /**
     * Abstract definitions cannot be the target of references
     *
     * @param Definition[] $definitions
     * @return Definition[]
     */
    private function filterOutAbstractDefinitions(array $definitions) : array
    {
        foreach ($definitions as $key => $definition) {
            if ($definition->isAbstract()) {
                unset($definitions[$key]);
            }
        }
        return $definitions;
    }
    /**
     * @param Definition[] $definitions
     * @return Reference[]
     */
    private function createReferencesFromDefinitions(array $definitions) : array
    {
        $references = [];
        $definitionOfTypeNames = \array_keys($definitions);
        foreach ($definitionOfTypeNames as $definitionOfTypeName) {
            $references[] = new Reference($definitionOfTypeName);
        }
        return $references;
    }
}