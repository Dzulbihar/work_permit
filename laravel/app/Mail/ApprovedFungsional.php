<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApprovedFungsional extends Mailable
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

        return $this->subject('Persetujuan Pekerjaan dari Fungsional TPKS')
                    ->view('emails.approved_fungsional')
                    ->with([
                        'company' => $this->job->user->company,
                        
                        'job_name' => $this->job->job_name,
                        'job_no' => $this->job->job_no,
                        'location' => $this->job->location,
                        'area' => $this->job->area,

                        'start_work' => $this->job->start_work,
                        'end_work' => $this->job->end_work,

                        'meetingDate' => $this->job->meeting_date,
                        'description' => $this->job->description,
                        'senderName' => $sender, 
                    ]);
    }
}
