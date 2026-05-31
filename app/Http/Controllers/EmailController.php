<?php

namespace App\Http\Controllers;

use App\Mail\InquiryEmail;
use App\Mail\AcknowledgementEmail;
use App\Http\Requests\EmailRequest;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    public function store(EmailRequest $request) {
        $request->validated();

        $userName = $request->input('name');
        $userEmail = $request->input('email');
        $userSubject = $request->input('subject');
        $userMessage = $request->input('message');

        $adminEmail = config('mail.mailers.smtp.username');

        Mail::to($adminEmail)->queue(new InquiryEmail($userName, $userEmail, $userSubject, $userMessage));

        Mail::to($userEmail)->queue(new AcknowledgementEmail($userName, $userMessage));
        
        return response()->json(['message' => 'Data processed successfully!']);
    }
}
