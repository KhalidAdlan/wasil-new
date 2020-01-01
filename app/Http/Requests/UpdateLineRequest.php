<?php

namespace App\Http\Requests;

use App\Line;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateLineRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('line_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'number' => [
                'required',
            ],
        ];
    }
}
