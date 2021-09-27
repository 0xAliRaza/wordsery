<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'content' => 'required|string',
            'type' => 'required|string|in:note,summary',
            'book' => 'required|array',
            'book.title' => 'required|string|max:255',
            'book.google_uuid' => 'required|string|max:255',
            'book.subtitle' => 'nullable|string|max:255',
            'book.publisher' => 'required|string|max:255',
            'book.published_date' => 'required|integer|max:' . date("Y"),
            'book.self_link' => 'required|string|max:2048',
            'book.thumbnail_link' => 'nullable|string|max:2048',
            'book.authors' => 'required|array',
            'book.authors.*' => 'required|string|distinct|max:255'
        ];
    }
}
