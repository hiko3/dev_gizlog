<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'tag_category_id' => 'required|int|exists:tag_categories,id,deleted_at,NULL',
            'title'           => 'required|string|max:100',
            'content'         => 'required|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'required'    => '入力必須の項目です',
            'exists'      => 'カテゴリーを選択してください',
            'max'         => ':max文字以内で入力してください',
        ];
    }

    public function requestQuestion()
    {
        return $this->only('tag_category_id', 'title', 'content');
    }

    public function requestConfirm()
    {
        return $this->only('tag_category_id', 'title', 'content', 'id');
    }

}
