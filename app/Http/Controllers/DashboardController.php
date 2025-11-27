<?php

namespace App\Http\Controllers;

use App\Models\Incident;

class DashboardController extends Controller
{
    public function index()
    {
        // paginate for production-readiness; adjust per page as needed
        $incidents = Incident::with('user')->latest()->paginate(15);

        return view('dashboard', compact('incidents'));
    }
}
