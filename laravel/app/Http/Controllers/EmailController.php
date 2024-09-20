<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{
    public function email()
    {
        $title = "email";
        $emails = \App\Models\Email::all();
        
        return view('master_email.index',[
            'title' => $title,
            'emails' => $emails
        ]);
    }

    public function edit($id)
    {
        $title = "email";
        $email = Email::find($id);

        return view('master_email.edit',
            [
            'title' => $title,
            'email' => $email
        ]);
    }     

    public function update(Request $request, $id)
    {
        $email = Email::find($id);
        $email->update($request->all());

        return redirect ('/email')->with('success', 'Data successfully updated');
    }

}
