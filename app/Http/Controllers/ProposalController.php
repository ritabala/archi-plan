<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function __construct()
    {
        // abort_if(!has_module_access('view_proposal'), 403, 'Access Denied');
    }

    public function index()
    {
        // abort_if(!auth()->user()->getCachedPermissions()->contains('view_proposal'), 403);
        return view('proposal.index');
    }

    public function create()
    {
        // abort_if(!auth()->user()->getCachedPermissions()->contains('create_proposal'), 403);
        return view('proposal.create');
    }

    public function edit(Proposal $proposal)
    {
        // abort_if(!auth()->user()->getCachedPermissions()->contains('edit_proposal'), 403);
        return view('proposal.edit', compact('proposal'));
    }
} 