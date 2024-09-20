<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobApproved extends Mailable
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
        //$sender = Auth::user()->name;
        $sender = 'Terminal Petikemas Semarang';

        return $this->subject('Persetujuan Pekerjaan')
                    ->view('emails.job_approved')
                    ->with([
                        'jobName' => $this->job->job_name,
                        'jobDesc' => $this->job->job_desc,
                        'meetingDate' => $this->job->meeting_date,
                        'description' => $this->job->description,
                        'senderName' => $sender, 
                    ]);
    }
}
