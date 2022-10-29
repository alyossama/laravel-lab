<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;


class UpdatePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'title'=>"required|min:3|unique:posts,title,{$this->post}",
            'description'=>'required|min:10',
            'post-creator'=>'required|exists:users,id',
            'postImage'=>'image|mimes:jpg,png,jpeg',
        ];
    }
}
