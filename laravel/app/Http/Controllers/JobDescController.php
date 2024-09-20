<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Person;
use App\Models\Tool;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobApproved;
use Barryvdh\DomPDF\Facade\Pdf;

class JobDescController extends Controller
{
    public function job_desc()
    {
        $title = "job_desc";
        $jobs = Job::orderBy('job_name')->get();
        
        return view('job_desc.index', [
            'title' => $title,
            'jobs' => $jobs,
        ]);
    }  

    public function approve_hsse(Request $request, $id)
    {
        $job = Job::find($id);

        $job->update($request->all());

        $job->status = '1';
        $job->save();

        // Ambil email dari user yang terkait dengan job
        $userEmail = $job->user->email;

        // Kirim email
        //Mail::to('ahmad.dzulbihar69@gmail.com')->send(new JobApproved($job));
        Mail::to($userEmail)->send(new JobApproved($job));

        return redirect('/job_desc')->with('success', 'Data berhasil disetujui HSSE');
    }    

    public function approve_fungsional(Request $request, $id)
    {
        $job = Job::find($id);

        $job->update($request->all());

        $job->status = '2';
        $job->save();

        // Ambil email dari user yang terkait dengan job
        $userEmail = $job->user->email;

        // Kirim email
        //Mail::to('ahmad.dzulbihar69@gmail.com')->send(new JobApproved($job));
        Mail::to($userEmail)->send(new JobApproved($job));

        return redirect('/job_desc')->with('success', 'Data berhasil disetujui Fungsional');
    }  

    // public function reject($id)
    // {
    //     $job = \DB::table('job')->where('id', $id)->first();
    //     $job_sekarang = $job->status;

    //     if ($job_sekarang == '1') {
    //         \DB::table('job')->where('id', $id)->update([
    //             'status' => '0',
    //             'meeting_date' => '', 
    //             'description' => '' 
    //         ]);
    //     }

    //     return redirect('/job_desc')->with('success', 'Persetujuan data berhasil dibatalkan');
    // }

    public function downloadPDF($id)
    {
        $job = \App\Models\Job::find($id);
        $persons = Person::where('job_id', $id)->get();
        $tools = Tool::where('job_id', $id)->get();
      
        $pdf = PDF::loadview('job_desc.pdf',[
            'job'=>$job,
            'persons'=>$persons,
            'tools'=>$tools
        ])->setPaper('a4', 'portrait');

        return $pdf->stream();
        // return $pdf->download('laporan-job-pdf');
    }

    public function print($id)
    {
        $title = "job";
        $job = \App\Models\Job::find($id);
        $persons = Person::where('job_id', $id)->get();
        $tools = Tool::where('job_id', $id)->get();
        
        return view('job_desc.print',[
            'title' => $title,
            'job' => $job,
            'persons' => $persons,
            'tools' => $tools
        ]);
    }

    public function detail($id)
    {
        $title = "job";
        $job = Job::find($id);
        $persons = Person::where('job_id', $id)->get();
        $tools = Tool::where('job_id', $id)->get();
        return view('job_desc.detail',
            [
            'title' => $title,
            'job' => $job,
            'persons' => $persons,
            'tools' => $tools,
        ]);
    } 
    
}
