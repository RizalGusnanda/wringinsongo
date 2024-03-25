<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Tours;

class DashboardController extends Controller
{
    public function index()
    {
        $roleUser = Role::where('name', 'user')->first();
        $totalUsersWithRole = $roleUser ? $roleUser->users()->count() : 0;

        $totalTours = Tours::count();

        return view('home', [
            'totalUsersWithRole' => $totalUsersWithRole,
            'totalTours' => $totalTours,
        ]);
    }
}
