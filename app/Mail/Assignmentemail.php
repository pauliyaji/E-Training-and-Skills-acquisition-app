<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;

class Assignmentemail extends Mailable
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
        $stu_no = Session::get('stu_no');
        $data = Session::get('data');
        $mentorname = Session::get('mentorname');
        $ass_no = Session::get('ass_no');
        $settings = Setting::where('id',1)->first();
        $name = $settings->institution;
        return $this->from('info@gombetrainings.com', $name.', Trainings')
            ->view('emails.assignmentemail', compact('email', 'data', 'stu_no', 'mentorname', 'ass_no'));

    }
}
