<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Person;
use App\Models\Tool;
use App\Models\Tool2;
use App\Models\Monitoring;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovedHsse;
use App\Mail\ApprovedFungsional;
use App\Mail\AgreementFungsional;
use App\Mail\AgreementHsse;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Email;

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

        // Kirim email ke USER
        // Ambil email dari user yang terkait dengan job
        $userEmail = $job->user->email;

        //Mail::to('ahmad.dzulbihar69@gmail.com')->send(new JobApproved($job));
        Mail::to($userEmail)->send(new ApprovedHsse($job));

        // Kirim email ke ADMIN
        $email = Email::where('status', 'fungsional')->first()->email;
        Mail::to($email)->send(new AgreementHsse($job));

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
        Mail::to($userEmail)->send(new ApprovedFungsional($job));

        // Kirim email ke ADMIN
        $email = Email::where('status', 'hsse')->first()->email;
        Mail::to($email)->send(new AgreementFungsional($job));

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

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'status' => 'required|string|max:255',
        'job_id' => 'required',
    ]);

    Monitoring::create($validated);

    return redirect()->back()->with('success', 'Data monitoring berhasil ditambahkan');
}


    public function detail($id)
{
        $title = "job_desc";
        $job = Job::find($id);
        $persons = Person::where('job_id', $id)->get();
        $tools = Tool::where('job_id', $id)->get();
        $tools2 = Tool2::where('job_id', $id)->get();
        $monitorings = Monitoring::where('job_id', $id)->get();
        return view('job_desc.detail',
            [
            'title' => $title,
            'job' => $job,
            'persons' => $persons,
            'tools' => $tools,
            'tools2' => $tools2,
            'monitorings' => $monitorings, 
        ]);
    } 

    public function edit($id)
{
    $monitoring = Monitoring::find($id);
    return view('monitorings.edit', compact('monitoring'));
}


public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'status' => 'required|string|max:255',
    ]);

    $monitoring = Monitoring::find($id);
    $monitoring->update($validated);

    // Pastikan untuk mengarahkan ke rute dengan ID pekerjaan
    return redirect()->route('job_desc.detail', $monitoring->job_id)->with('success', 'Data monitoring berhasil diperbarui');
}


public function destroy($id)
{
    $monitoring = Monitoring::find($id);
    $monitoring->delete();

    return redirect()->back()->with('success', 'Data monitoring berhasil dihapus');
}


    
    
}