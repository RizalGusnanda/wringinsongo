<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('layout-users.contact');
    }

    public function send(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9_.+-]+@gmail\.com$/'],
            'pesan' => 'required'
        ], [
            'email.regex' => 'Alamat email harus berakhiran @gmail.com.'
        ]);

        Mail::to('rizalgusnanda24@gmail.com')->send(new ContactFormMail($validatedData));

        return back()->with('success', 'Pesan Anda telah berhasil dikirim.');
    }
}
