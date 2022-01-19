<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'    => 'required|min:3',
            'deadline_at'    => 'required|date|after:' . date('Y-m-d'),
        ];
    }


    public function attributes()
    {
        return [
            'name'    => trans('messages.name'),
            'deadline_at'    => trans('messages.deadline_at'),
        ];
    }
}
