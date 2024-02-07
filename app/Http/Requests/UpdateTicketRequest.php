<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'categories' => 'required|array',
            'labels' => 'required|array',
            'images' => 'required|array',
            'title' => 'required',
            'message' => 'required',
            'priority' => [
                'required',
                Rule::in(0, 1, 2)
            ]
        ];
    }
}
