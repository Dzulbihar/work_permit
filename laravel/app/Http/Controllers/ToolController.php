<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;

class ToolController extends Controller
{

    public function save(Request $request, $id)
    {
        $request->request->add([
            'job_id' => $id,
            'status' => 'Y'
        ]);
        $job = Tool::create($request->all());

        return redirect ('/job/detail/'. $id)->with('success', 'Data berhasil disimpan');
    }

    public function delete($id, $job_id)
    {
        $tool = Tool::find($id);
        $tool->delete($tool);

        return redirect ('/job/detail/'. $job_id)->with('success', 'Data berhasil dihapus');
    }   

}
