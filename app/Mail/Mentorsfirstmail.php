<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;

class Mentorsfirstmail extends Mailable
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
        $data = Session::get('data');
        $email = Session::get('email');
        $stu_no = Session::get('stu_no');
        $start = Session::get('start');
        $end = Session::get('end');
        $mentorname = Session::get('mentorname');
        $mentoremail = Session::get('mentoremail');
        $settings = Setting::where('id',1)->first();
        $name = $settings->institution;
        return $this->from('info@gombetrainings.com', $name.', Trainings')
            ->view('emails.mentorsfirstmail', compact('data','email', 'stu_no',  'end', 'start', 'mentoremail', 'mentorname'));

    }
}
