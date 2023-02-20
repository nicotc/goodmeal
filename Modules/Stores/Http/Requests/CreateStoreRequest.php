<?php

namespace Modules\Stores\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateStoreRequest extends FormRequest
{
    use HttpResponse;

    /**
     *
     * @OA\Schema(
     *  schema="CreateStoreRequest",
     * type="object",
     * required={"name", "logo", "header", "address", "latitude", "longitude", "withdrawal_schedule", "ratings"},
     * @OA\Property(
     * property="name",
     * type="string",
     * example="Store Name",
     * ),
     * @OA\Property(
     * property="logo",
     * type="string",
     * format="binary",
     * ),
     * @OA\Property(
     * property="header",
     * type="string",
     * format="binary",
     * ),
     * @OA\Property(
     * property="address",
     * type="string",
     * example="Store Address",
     * ),
     * @OA\Property(
     * property="latitude",
     * type="number",
     * format="float",
     * example="12.3456789",
     * ),
     * @OA\Property(
     * property="longitude",
     * type="number",
     * format="float",
     * example="12.3456789",
     * ),
     *  @OA\Property(
     * property="withdrawal_schedule",
     * type="string",
     * example="Store Withdrawal Schedule",
     * ),
     * @OA\Property(
     * property="ratings",
     * type="integer",
     * example="Store Ratings",
     * ),
     * )
     * @return array
     */
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:500',
            'header' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:500',
            'address' => 'required|string|max:500',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'withdrawal_schedule' => 'required|string|max:255',
            'ratings' => 'required|integer|between:0,5',
        ];

    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            $this->send422Response($errors)
        );
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
