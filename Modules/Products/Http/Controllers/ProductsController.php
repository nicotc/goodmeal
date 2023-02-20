<?php

namespace Modules\Products\Http\Controllers;

use Exception;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Products\Entities\Product;
use Modules\Stores\Http\Requests\CreateProductRequest;
use Modules\Stores\Http\Requests\UpdateProductRequest;

class ProductsController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(): JsonResponse
    {

        try {
            $products = Product::all();
            return $this->send200Response($products);
        } catch (Exception $e) {
            return $this->getResponse($e->getCode(), 'Unexpected Error', $e->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
        try {
            $products = new Product();
            $products->name = $request->name;
            $products->description = $request->description;
            $products->price = $request->price;
            $products->discount = $request->discount;
            $products->image = $request->image;
            $products->category = $request->category;
            $products->stock = $request->stock;
            $products->store_id = $request->store_id;
            $products->save();
            return $this->send201Response($products);
        } catch (Exception $e) {
            return $this->getResponse($e->getCode(), 'Unexpected Error', $e->getMessage());
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id): JsonResponse
    {
        try{
            $products = Product::findOrFail($id);
            return $this->send200Response($products);
        } catch (Exception $e) {
            return $this->getResponse($e->getCode(), 'Unexpected Error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateProductRequest $request, $id): JsonResponse
    {
        try{
            $products = Product::findOrFail($id);
            $products->name = $request->name;
            $products->description = $request->description;
            $products->price = $request->price;
            $products->discount = $request->discount;
            $products->image = $request->image;
            $products->category = $request->category;
            $products->stock = $request->stock;
            $products->store_id = $request->store_id;
            $products->save();
            return $this->send202Response($products);
        } catch (Exception $e) {
            return $this->getResponse($e->getCode(), 'Unexpected Error', $e->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return $this->send202Response('Selected file deleted');
        } catch (Exception $e) {
            return $this->getResponse($e->getCode(), 'Unexpected Error', $e->getMessage());
        }
    }
}
