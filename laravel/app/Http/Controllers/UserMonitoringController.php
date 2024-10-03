<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserMonitoringController extends Controller
{
    public function index()
    {
        // Ambil semua data user dari tabel users
        $users = User::all();

        // Kirim data ke view user-monitoring
        return view('user-monitoring.index', compact('users'));
    }
}

