<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class JobRequest extends Mailable
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

        return $this->subject('Permintaan Persetujuan Pekerjaan')
                    ->view('emails.job_request')
                    ->with([
                        'jobPT' => $this->job->user->name,
                        'jobName' => $this->job->job_name,
                        'jobDesc' => $this->job->job_desc,
                        'jobStartWork' => $this->job->start_work,
                        'jobEndWork' => $this->job->end_work,
                        'senderName' => $sender, 
                    ]);
    }
}
