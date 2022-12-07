<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;

class AssignmentSubmission extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = Session::get('email');
        $student = Session::get('student');
        $ass_no = Session::get('ass_no');
        $settings = Setting::where('id',1)->first();
        $name = $settings->institution;

        return $this->from('info@gombetrainings.com', $name.', Trainings')
            ->view('emails.submissionemail', compact('email', 'student', 'ass_no'));

    }
}
