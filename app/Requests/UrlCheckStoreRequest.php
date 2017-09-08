<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UrlCheckStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'url' => 'string'
        ];
    }

    public function response(array $errors)
    {
        return new JsonResponse($errors, 400);
    }
}
