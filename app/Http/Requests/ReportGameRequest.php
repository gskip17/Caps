<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReportGameRequest extends Request
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
            "t1p1Cups" => 'required|max:9|min:0',
            "t1p2Cups" => 'required|max:9|min:0',
            "t2p1Cups" => 'required|max:9|min:0',
            "t2p2Cups" => 'required|max:9|min:0',
        ];
    }
}
