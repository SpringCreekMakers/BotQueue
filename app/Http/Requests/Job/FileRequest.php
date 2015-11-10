<?php

namespace App\Http\Requests\Job;

use App\Http\Requests\Request;

class FileRequest extends Request
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
            'name' => 'required',
            'queue' => 'required|exists:queues,id',
            'quantity' => 'required|numeric|min:0|max:100'
        ];
    }
}
