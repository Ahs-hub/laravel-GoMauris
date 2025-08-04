<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Contact;

//For notification
use App\Models\AdminNotification;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'service' => 'required|string',
            'message' => 'nullable|string|max:1000',
        ]);

        // Optionally send an email or store in DB
        // Mail::to('admin@example.com')->send(new ContactMail($validated));

        // Save to database
        $booking = Contact::create([
            'first_name' => $validated['firstName'],
            'last_name' => $validated['lastName'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'service' => $validated['service'],
            'message' => $validated['message'],
        ]);


        // Notification
        AdminNotification::create([
            'type' => 'ContactBooking',
            'related_id' => $booking->id, // ✅ Corrected here
        ]);
                    

        $type = $request->query('type', 'car'); // Defaults to 'car' if not provided
         return redirect()->route('thankyou', ['type' => $type]);

    }
}
