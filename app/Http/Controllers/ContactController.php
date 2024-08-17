<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'string|required',
            'email' => 'string|email|required',
            'subject' => 'string|required',
            'message' => 'string|required'
        ]);

        Contact::create($validate);

        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }
}
