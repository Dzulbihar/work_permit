<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class AgreementFungsional extends Mailable
{
    use Queueable, SerializesModels;

    public $job;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job)
    {
        $this->job = $job;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Mengambil informasi user yang sedang login (pengirim)
        $sender = Auth::user()->name;

        return $this->subject('Kesepakatan Penentuan Tanggal Rapat Izin Kerja dari Fungsional')
                    ->view('emails.agreement_fungsional')
                    ->with([
                        'company' => $this->job->user->company,
                        'name' => $this->job->user->name,
                        'npwp' => $this->job->user->npwp,
                        'nohp' => $this->job->user->nohp,
                        'email' => $this->job->user->email,

                        'job_name' => $this->job->job_name,
                        'job_no' => $this->job->job_no,
                        'location' => $this->job->location,
                        'area' => $this->job->area,

                        'jobStartWork' => $this->job->start_work,
                        'jobEndWork' => $this->job->end_work,

                        'meetingDate' => $this->job->meeting_date,
                        'description' => $this->job->description,
                        'senderName' => $sender, 
                    ]);
    }
}
