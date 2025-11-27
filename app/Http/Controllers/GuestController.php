<?php

namespace App\Http\Controllers;

use App\Models\Incident;

class GuestController extends Controller
{
    public function index()
    {
        $incidents = Incident::latest()->get();

        return view('guest-dashboard', [
            'incidents' => $incidents
        ]);
    }
}
