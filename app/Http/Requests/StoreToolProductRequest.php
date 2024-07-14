<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreToolProductRequest extends FormRequest
{
  
  public function authorize(): bool{
      return true;
  }

     

public function rules(): array{
    return ["tool_id" => ["required", "integer"]];
}

}