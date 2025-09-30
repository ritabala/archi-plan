<?php

use App\Models\Firm;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

function user()
{
    if (session()->has('user')) {
        return session()->get('user');
    }

    session()->put('user', auth()->user());

    return session()->get('user');
}

function has_module_access($module_name)
{
   
}
