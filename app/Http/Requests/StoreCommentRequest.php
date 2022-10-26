<?php

namespace App\Http\Requests;

use App\Rules\CommentsLimit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCommentRequest extends FormRequest
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
        // $user = Auth::user();
        // dd($user,$user->comment);
        return [
            'comment'=>'required',
            'user_comment_count'=>new CommentsLimit()
        ];
    }
}