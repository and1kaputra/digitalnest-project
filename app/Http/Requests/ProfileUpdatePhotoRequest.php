<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class ProfileUpdatePhotoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     * 
     * 
     */

     public function authorize(): bool
     {
         return true;
     }
     
    public function rules(): array
    {
        return [
            'avatar' => ['required', 'image', 'mimes:png,jpg,jpeg,webp'],
        ];
    }
}
