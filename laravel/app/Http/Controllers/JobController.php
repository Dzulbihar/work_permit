<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Person;
use App\Models\Tool;
use App\Models\Tool2;
use App\Models\Email;
use Auth;
use Illuminate\Support\Facades\DB; 
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestUserHsse;
use App\Mail\RequestUserFungsional;

class JobController extends Controller
{

    public function job()
    {
        $title = "job";
        //$jobs = \App\Models\Job::all();
        $jobs = Job::where('user_id', Auth::user()->id)->get();
        
        return view('job.index',[
            'title' => $title,
            'jobs' => $jobs,
        ]);
    }

    public function add()
    {
        $title = "job";
        $klasifikasiKerja = \App\Models\KlasifikasiKerja::all(); // Mengambil semua klasifikasi kerja dari database
        return view('job.add', [
            'title' => $title,
            'klasifikasiKerja' => $klasifikasiKerja,
        ]);
    }

    public function save(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'job_no' => 'required|string|max:255',
            'job_class' => 'required|array|min:1',
            'job_name' => 'required|string',
            'location' => 'required|string',
            'area' => 'required|string',
            'start_work' => 'required|date',
            'end_work' => 'required|date',
            'document' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:2048', // Validasi untuk file tunggal
        ]);

        // Gabungkan job_class menjadi string
        $validated['job_class'] = implode(',', $request->job_class);
        $validated['user_id'] = Auth::user()->id;
        $validated['status'] = '0';

        // Simpan data ke database
        $job = Job::create($validated);

        // Tambah document
        if ($request->hasFile('document')) {
            $file_document = time() . "_" . $request->file('document')->getClientOriginalName();
            $request->file('document')->move('images/', $file_document);
            $job->document = $file_document; // Simpan nama file dokumen ke model
            $job->save(); // Simpan perubahan ke database
        }

        // Redirect setelah berhasil menyimpan
        return redirect('/job')->with('success', 'Data berhasil disimpan');
    }


    public function edit($id)
    {
        $title = "job";
        $job = Job::find($id);
        $klasifikasiKerja = \App\Models\KlasifikasiKerja::all(); // Mengambil klasifikasi kerja dari database
        $selectedJobClass = explode(',', $job->job_class); // Ubah job_class menjadi array
        
        return view('job.edit', [
            'title' => $title,
            'job' => $job,
            'klasifikasiKerja' => $klasifikasiKerja,
            'selectedJobClass' => $selectedJobClass, // Nilai yang telah dipilih untuk checkbox
        ]);
    }

    public function update(Request $request, $id)
    {
            // Temukan job berdasarkan id
        $job = Job::find($id);

            // Validasi input (opsional, tetapi disarankan untuk menambahkan validasi)
        $request->validate([
            'job_no' => 'required|string|max:255',
            'job_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'start_work' => 'required|date',
            'end_work' => 'required|date',
                'job_class' => 'array', // Pastikan job_class adalah array
            ]);

            // Proses data untuk job_class (array dari checkbox)
        if ($request->has('job_class')) {
                // Ubah array menjadi string yang dipisahkan dengan koma
            $job_class = implode(',', $request->job_class);
        } else {
                // Jika tidak ada checkbox yang dicentang, simpan sebagai string kosong
            $job_class = '';
        }

            // Update data job
        $job->update([
            'job_no' => $request->job_no,
            'job_name' => $request->job_name,
            'location' => $request->location,
            'area' => $request->area,
            'start_work' => $request->start_work,
            'end_work' => $request->end_work,
                'job_class' => $job_class, // Simpan job_class sebagai string
            ]);

            // Redirect setelah berhasil mengupdate data
        return redirect('/job')->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $job = Job::find($id);
        $job->delete($job);

        return redirect('job')->with('success', 'Data berhasil dihapus');
    }      

    public function downloadPDF($id)
    {
        $job = \App\Models\Job::find($id);
        $persons = Person::where('job_id', $id)->get();
        $tools = Tool::where('job_id', $id)->get();

        $pdf = PDF::loadview('job.pdf',[
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

        return view('job.print',[
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
        $tools2 = Tool2::where('job_id', $id)->get();

        return view('job.detail',
            [
                'title' => $title,
                'job' => $job,
                'persons' => $persons,
                'tools' => $tools,
                'tools2' => $tools2
            ]);
    }   

    ///////////////////////////////////////////////////////////////////////////

    public function request_email_hsse(Request $request, $id)
    {
            // Temukan job berdasarkan ID
        $job = Job::find($id);

            // Ambil email yang aktif dari model Email (misalnya dengan status 'active')
        $email = Email::where('status', 'hsse')->first()->email;

            // Kirim email ke alamat email yang diambil dari database
        Mail::to($email)->send(new RequestUserHsse($job));

        return redirect('/job')->with('success', 'Permintaan persetujuan berhasil dikirim ke HSSE');
    }

    public function request_email_fungsional(Request $request, $id)
    {
            // Temukan job berdasarkan ID
        $job = Job::find($id);

            // Ambil email yang aktif dari model Email (misalnya dengan status 'active')
        $email = Email::where('status', 'fungsional')->first()->email;

            // Kirim email ke alamat email yang diambil dari database
        Mail::to($email)->send(new RequestUserFungsional($job));

        return redirect('/job')->with('success', 'Permintaan persetujuan berhasil dikirim ke Fungsional');
    }    

}