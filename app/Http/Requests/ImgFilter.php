<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImgFilter extends FormRequest
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
            'name' => 'required|min:6',
            'file' => 'required|image:jpg,png|lte:2097152'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名称不能为空',
            'name.min' => '名称最小长度6',
            'file.required' => '文件对象不能为空',
            'file.image' => '图片格式不正确jpg或png',
            'file.lte' => '图片不能大于2m'
        ];
    }
}
