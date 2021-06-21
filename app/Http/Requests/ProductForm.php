<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Auth;

class ProductForm extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request) {
        $requestVal = [];
        $requestVal['name'] = $request->id ? 'required|unique:products,name,' . $request->id : 'required|unique:products';
        $requestVal['category'] = 'required';
        $requestVal['description'] = 'required';
//        $requestVal['image'] = 'required|mimes:jpeg,png|dimensions:max_width=150,max_height=150';
        $request->validate($requestVal);
        return $requestVal;
    }

}
