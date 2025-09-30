<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __construct()
    {
        // abort_if(!has_module_access('view_portfolio'), 403, 'Access Denied');
    }

    public function index()
    {
        // abort_if(!auth()->user()->getCachedPermissions()->contains('view_portfolio'), 403);
        return view('portfolio.index');
    }

    public function create()
    {
        // abort_if(!auth()->user()->getCachedPermissions()->contains('create_portfolio'), 403);
        return view('portfolio.create');
    }

    public function edit(Portfolio $portfolio)
    {
        // abort_if(!auth()->user()->getCachedPermissions()->contains('edit_portfolio'), 403);
        return view('portfolio.edit', compact('portfolio'));
    }
} 