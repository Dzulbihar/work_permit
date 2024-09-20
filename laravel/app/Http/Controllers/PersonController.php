<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{

    public function save(Request $request, $id)
    {
        $request->request->add([
            'job_id' => $id,
            'status' => 'Y'
        ]);
        $person = Person::create($request->all());

        return redirect ('/job/detail/'. $id)->with('success', 'Data berhasil disimpan');
    }

    public function delete($id, $job_id)
    {
        $person = Person::find($id);
        $person->delete($person);

        return redirect ('/job/detail/'. $job_id)->with('success', 'Data berhasil dihapus');
    }   
 
}
