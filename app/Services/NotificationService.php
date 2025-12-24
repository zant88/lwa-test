<?php 
namespace App\Services;

use App\Models\User;
use App\Mail\UserWelcomeEmail;
use App\Mail\AdminNewUserNotification;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function sendUserRegistrationNotification(User $user): void
    {
        Mail::to($user->email)->send(new UserWelcomeEmail($user));
       
        $adminEmail = config('mail.admin_email');
        Mail::to($adminEmail)->send(new AdminNewUserNotification($user));
    }
}