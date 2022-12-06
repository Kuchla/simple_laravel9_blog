<?php

namespace App\Http\Requests;

class PostRequest
{
    private $formAction;

    public function __construct($formAction)
    {
        $this->formAction = $formAction;
    }

    public function rules()
    {
        return [
            'post.title' => 'required|min:2',
            'post.description' => 'required|min:2',
            'post.text' => 'required|min:1',
            'post.active' => 'boolean',
            'post.category_id' => 'required|exists:categories,id',
            'image' => $this->formAction == 'create' ? 'image|mimes:jpeg,jpg,png|required' : 'nullable'
        ];
    }
}
