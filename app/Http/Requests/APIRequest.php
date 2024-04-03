<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use function response;

class APIRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = [];
        foreach ($validator->errors()->toArray() as $error) {
            foreach ($error as $err) {
                $errors[] = $err;
            }
        }
        $response = response()->json([
            'message' => 'Invalid data send',
            'errors' => $errors,
        ], 422);
        throw new HttpResponseException($response);
    }
}
