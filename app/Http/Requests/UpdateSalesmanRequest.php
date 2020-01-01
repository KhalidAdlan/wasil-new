<?php

namespace App\Http\Requests;

use App\Salesman;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSalesmanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('salesman_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'     => [
                'required',
            ],
            'username' => [
                'required',
            ],
            'password' => [
                'required',
            ],
        ];
    }
}
