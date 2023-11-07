<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;



class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $input;
    public $data;
    public $result;
    public $title;

    /**
     * Create a new message instance.
     */
    public function __construct($title, $data , $result)
    {
        $this->title = $title;
        $this->$data = $data;
        $this->$result = $result;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.job_acceptance.acceptance',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
    public function build()
    {
        $address = env('MAIL_FROM_ADDRESS');
        $name = env('MAIL_FROM_NAME');
        
        return $this
        ->from($address, $name)
        ->cc($address, $name)
        ->replyTo($address, $name)
        ->subject($this->title) 
        >with(['data' => $this->data, 'result' => $this->result]); 
    }
}
