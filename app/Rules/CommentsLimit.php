<?php

namespace App\Rules;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;

class CommentsLimit implements Rule
{
    public $postId;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($postId)
    {
        $this->postId = $postId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $countUserComments = Post::find($this->postId)->comments()->where('user_id', Auth::id())->count();
        return ($countUserComments < 3) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You have exceeded your limit of comments';
    }
}
