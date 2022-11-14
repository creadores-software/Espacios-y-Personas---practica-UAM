<?php

namespace App\Http\Requests\Person;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "firstname" => "required|min:3|max:20|string",
            "secondname" => "required|min:3|max:20|string",
            "lastname" => "required|min:3|max:20|string",
            "secondLastname" => "required|min:3|max:20|string",
            "public_email" => "required|min:20|max:70|string",
            "birthday" => "required|min:5|max:10|string",
            "slug" => "unique:people|string", //|unique:people
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        if($this->expectsJson()){
            $response = new Response($validator->errors(),422);
            throw new ValidationException($validator, $response);
        }
    }
}
