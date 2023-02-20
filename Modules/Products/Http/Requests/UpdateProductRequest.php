<?php

namespace Modules\Stores\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProductRequest extends FormRequest
{
    use HttpResponse;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */


    public function rules()
    {


        return [

            'store_id' => 'integer|exists:stores,id',
            'name' => 'string',
            'description' => 'string',
            'price' => 'numeric',
            'discount' => 'numeric',
            'stock' => 'integer',
            'image' => 'string',
            'category' => 'string|in:food,drink,dessert,other',
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
