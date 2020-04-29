<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Application;

class ApplicationShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $status;
    protected $application;
    protected $comment;

    public function __construct($status, Application $application, $comment = Null)
    {
        $this->status = $status;
        $this->application = $application;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $status = $this->status;
        $application = $this->application;
        $comment = $this->comment;
        if ($this->comment == null) {
            return $this->view('email.mail', compact('status', 'application'));
        }
        return $this->view('email.mail', compact('status', 'application', 'comment'));
    }
}
