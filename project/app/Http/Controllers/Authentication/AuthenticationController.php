<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    public function forgot_password() {
        return view('authentication.forgot_password');
    }

    public function forgot_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if($user) {
            // Generate a unique reset token for the customer
            $token = hash('sha256', time());
            $user->verification_token = $token;
            $user->update();
            // Generate a password reset link for the customer
            $reset_link = url('reset-password/' . $token . '/' . $request->email);
            
            // Define the subject for the password reset email
            $subject = 'PCLU Queue Management System - Reset Password';
            
            // Create the email message content with the password reset link
            $message = '<p>Dear'.$user->firstname.',</p>';
            $message .= '<p>We received a request to reset your password for the PCLU Queue Management System account associated with this email address. If you did not request a password reset, please ignore this email.</p>';
            $message .= '<p>To reset your password, please click on the following link or copy and paste it into your browser:</p>';
            $message .= '<a href="' . $reset_link . '">Click here</a>';
            $message .= '<p>If you have any issues or did not request this change, please contact our support team immediately.</p><br>';
            $message .= '<p>Best Regard,</p>';
            $message .= '<p>PCLU Queue Management System Team</p>';
            // Send the password reset email to the customer
            Mail::to($request->email)->send(new WebsiteMail($subject, $message));

            // Redirect to the customer login page with a success message prompting the customer to check their email
            return redirect()->route('login')->with('success', 'Please check your email and click the link to verify.');
        } else {
            return redirect()->back()->with('error', 'No record found!');
        }
    }

    public function reset_password($token, $email) {
        $user_data = User::where('token', $token)->where('email', $email)->first();

        if($user_data) {
            return view('authentication.reset_password', compact('token', 'email'));
        } else {
            return redirect()->route('login')->with('error', 'Something went wrong. Please try again!');
        }
    }
    
}
