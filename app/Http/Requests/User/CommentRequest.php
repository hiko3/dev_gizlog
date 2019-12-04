<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'comment' => 'required|nullable|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => '入力必須の項目です。',
            'max'              => ':max文字以内で入力してください'
        ];
    }

    public function fetchComment()
    {
        return $this->only('user_id', 'question_id', 'comment');
    }
}

