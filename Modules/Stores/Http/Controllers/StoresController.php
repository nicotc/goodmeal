<?php

namespace Modules\Stores\Http\Controllers;

use Exception;
use App\Traits\AuthRol;
use App\Traits\HttpResponse;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Stores\Entities\Store;
use Modules\Stores\Http\Requests\CreateStoreRequest;
use Modules\Stores\Http\Requests\UpdateStoreRequest;

class StoresController extends Controller
{
    use HttpResponse;


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(): JsonResponse
    {

        // dd(auth()->user());
        try {
            $store = Store::with('products')->get();
            return $this->send200Response($store);
        } catch (Exception $e) {
            return $this->getResponse($e->getCode(), 'Unexpected Error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CreateStoreRequest $request): JsonResponse
    {

        try {

            $logo_path = $request->file('logo')->store('image', 'public');
            $header_path = $request->file('header')->store('image', 'public');

            $store = new Store();
            $store->name = $request->name;
            $store->logo = $logo_path;
            $store->header = $header_path;
            $store->address = $request->address;
            $store->latitude = $request->latitude;
            $store->longitude = $request->longitude;
            $store->withdrawal_schedule = $request->withdrawal_schedule;
            $store->ratings = $request->ratings;
            $store->save();



            return $this->send201Response($store);
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
        try {
            $store = Store::findOrFail($id);
            return $this->send200Response($store);
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
    public function update(UpdateStoreRequest $request, $id): JsonResponse
    {
        try {

            if($request->hasFile('logo')){
                $logo_path = $request->file('logo')->store('image', 'public');
            }
            if($request->hasFile('header')){
                $header_path = $request->file('header')->store('image', 'public');
            }

            $store = Store::findOrFail($id);
            $store->name = $request->name ?? $store->name;
            $store->logo = $logo_path ?? $store->logo;
            $store->header = $header_path ?? $store->header;
            $store->address = $request->address ?? $store->address;
            $store->latitude = $request->latitude   ?? $store->latitude;
            $store->longitude = $request->longitude ?? $store->longitude;
            $store->withdrawal_schedule = $request->withdrawal_schedule ?? $store->withdrawal_schedule;
            $store->ratings = $request->ratings ?? $store->ratings;
            $store->save();

            return $this->send202Response($store);
        } catch (Exception $e) {
            return $this->getResponse($e->getCode(), 'Unexpected Error', $e->getMessage());
        }

        // return $this->send202Response($updateDepartment);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id): JsonResponse
    {
        try {
            $store = Store::findOrFail($id);
            $store->delete();
            return $this->send202Response('Selected file deleted');
        } catch (Exception $e) {
            return $this->getResponse($e->getCode(), 'Unexpected Error', $e->getMessage());
        }
    }
}
