<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'images.*' => ['image', 'max:5120'], // 5MB
            'images' => ['array', 'max:10'], // 最多10张图片
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.max' => '标题不能超过255个字符',
            'content.required' => '内容不能为空',
            'images.*.image' => '上传的文件必须是图片',
            'images.*.max' => '图片大小不能超过5MB',
            'images.max' => '最多只能上传10张图片',
        ];
    }
} 