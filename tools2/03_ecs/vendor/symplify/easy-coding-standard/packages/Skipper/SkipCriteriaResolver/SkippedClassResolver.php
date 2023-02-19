<?php

declare (strict_types=1);
namespace Symplify\EasyCodingStandard\Skipper\SkipCriteriaResolver;

use Symplify\EasyCodingStandard\ValueObject\Option;
use ECSPrefix202211\Symplify\PackageBuilder\Parameter\ParameterProvider;
use ECSPrefix202211\Symplify\PackageBuilder\Reflection\ClassLikeExistenceChecker;
final class SkippedClassResolver
{
    /**
     * @var array<string, string[]|null>
     */
    private $skippedClasses = [];
    /**
     * @var \Symplify\PackageBuilder\Parameter\ParameterProvider
     */
    private $parameterProvider;
    /**
     * @var \Symplify\PackageBuilder\Reflection\ClassLikeExistenceChecker
     */
    private $classLikeExistenceChecker;
    public function __construct(ParameterProvider $parameterProvider, ClassLikeExistenceChecker $classLikeExistenceChecker)
    {
        $this->parameterProvider = $parameterProvider;
        $this->classLikeExistenceChecker = $classLikeExistenceChecker;
    }
    /**
     * @return array<string, string[]|null>
     */
    public function resolve() : array
    {
        if ($this->skippedClasses !== []) {
            return $this->skippedClasses;
        }
        $skip = $this->parameterProvider->provideArrayParameter(Option::SKIP);
        foreach ($skip as $key => $value) {
            // e.g. [SomeClass::class] → shift values to [SomeClass::class => null]
            if (\is_int($key)) {
                $key = $value;
                $value = null;
            }
            if (!\is_string($key)) {
                continue;
            }
            if (!$this->classLikeExistenceChecker->doesClassLikeExist($key)) {
                continue;
            }
            $this->skippedClasses[$key] = $value;
        }
        return $this->skippedClasses;
    }
}