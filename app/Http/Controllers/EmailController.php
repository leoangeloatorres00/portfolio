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
        $userMessage = $request->input('message');

        $adminEmail = config('mail.from.address');

        Mail::to($adminEmail)->queue(new InquiryEmail($userName, $userEmail, $userMessage));

        Mail::to($userEmail)->queue(new AcknowledgementEmail($userName, $userMessage));
        
        return response()->json(['message' => 'Data processed successfully!']);
    }
}
