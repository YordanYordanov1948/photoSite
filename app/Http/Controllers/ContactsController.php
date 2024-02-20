<?php

namespace App\Http\Controllers;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;


use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contacts.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Store the message in the database
        $contactMessage = ContactMessage::create($validated);

        // Send email
        Mail::to('destination@example.com')->send(new ContactFormMail($validated));

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
