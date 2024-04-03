<?php

namespace Users\Http\Requests\API;

use App\Http\Requests\APIRequest;

class UpdateCountryRequest extends APIRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description.ar' => 'required',
            'description.en' => 'required',
            'name.ar' => 'required',
            'name.en' => 'required',
            ];
    }
}
