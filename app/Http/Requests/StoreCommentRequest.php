<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'post_id' => ['required', 'exists:posts,id'],
            'content' => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages()
    {
        return [
            'post_id.required' => '帖子ID不能为空',
            'post_id.exists' => '帖子不存在',
            'content.required' => '评论内容不能为空',
            'content.max' => '评论内容不能超过1000个字符',
        ];
    }
} 