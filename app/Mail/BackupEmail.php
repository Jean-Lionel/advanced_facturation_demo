<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BackupEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $title;

    public $data;
    public $file;
    public function __construct($file ,$data = [
        'message' => 'message par default'
    ])
    {
        $this->file = $file;
        $this->data = $data;
        $this->title  = " Backup du ". date("Y-m-d H:i:s") . ' Pour '. RAISON_ENTREPRISE_HEADER;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                 ->from("info@artb.bi") // L'expéditeur
                 ->subject($this->title) // Le sujet
                 ->attach($this->file)
                 ->view('emails.backup');
    }
}
