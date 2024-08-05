<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ArticlePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }


    public function create() {
        return Auth::check();
    }

    public function update() {
        return Auth::check();
    }

    public function delete() {
        return Auth::check();
    }
}
