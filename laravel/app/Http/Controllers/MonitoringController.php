<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function monitoring()
    {
        $title = "monitoring";
        //$emails = \App\Models\Email::all();
        
        return view('monitoring.index',[
            'title' => $title,
            //'emails' => $emails
        ]);
    }
}
