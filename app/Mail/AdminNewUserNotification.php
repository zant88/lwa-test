<?php
namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class AdminNewUserNotification extends Mailable
{
    public function __construct(public User $user)
    {  }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New User Registration'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-new-user'
        );
    }
}