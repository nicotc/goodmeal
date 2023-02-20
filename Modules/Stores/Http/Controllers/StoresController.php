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
     * @OA\Get(
     * path="/stores",
     * summary="show all stores",
     * description="show all stores",
     * operationId="show all stores",
     * tags={"Stores"},
     * security={ {"bearer": {} }},
     * @OA\Response(
     * response=200,
     * description="successful operation",
     * @OA\JsonContent(
     * type="array",
     * @OA\Items(ref="#/components/schemas/Store")
     * ),
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthenticated",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * ),
     *
     *   )
     */




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
     * @OA\Post(
     * path="/stores",
     * summary="create new store",
     * description="create new store",
     * operationId="create new store",
     * tags={"Stores"},
     *
        * security={ {"bearer": {} }},
        * @OA\RequestBody(
        *    required=true,
        *    description="Pass store data",
        *    @OA\JsonContent(
        *       required={"name", "logo", "header", "address", "latitude", "longitude", "withdrawal_schedule", "ratings"},
        *       @OA\Property(property="name", type="string", example="Store Name"),
        *       @OA\Property(property="logo", type="string", format="binary"),
        *       @OA\Property(property="header", type="string", format="binary"),
        *       @OA\Property(property="address", type="string", example="Store Address"),
        *       @OA\Property(property="latitude", type="number", format="float", example="12.3456789"),
        *       @OA\Property(property="longitude", type="number", format="float", example="12.3456789"),
        *       @OA\Property(property="withdrawal_schedule", type="string", example="Store Withdrawal Schedule"),
        *       @OA\Property(property="ratings", type="number", format="float", example="12.3456789"),
        *    ),
        * ),
        * @OA\Response(
        *    response=201,
        *    description="successful operation",
        *    @OA\JsonContent(
        *       @OA\Property(property="message", type="string", example="Store created successfully"),
        *       @OA\Property(property="data", ref="#/components/schemas/Store"),
        *    ),
        * ),
        * @OA\Response(
        *    response=400,
        *    description="Bad Request",
        *    @OA\JsonContent(
        *       @OA\Property(property="message", type="string", example="Bad Request"),
        *       @OA\Property(property="errors", type="object", ref="#/components/schemas/Store"),
        *    ),
        * ),
        * @OA\Response(
        *    response=401,
        *    description="Unauthenticated",
        * ),
        * @OA\Response(
        *    response=403,
        *    description="Forbidden"
        * ),
        *
        * )
        */
        



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
