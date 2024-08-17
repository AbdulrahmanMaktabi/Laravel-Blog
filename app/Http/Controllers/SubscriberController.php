<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validate = $request->validate([
            'email' => 'required|email|string|unique:subscribers,email'
        ]);

        // Create a new subscriber using the validated data
        Subscriber::create($validate);

        // Redirect to the 'theme.home' route with a success message
        return back()->with('subscriber.success', 'You have successfully subscribed.');
    }
    public function store2(Request $request)
    {
        // Validate the incoming request data
        $validate = $request->validate([
            'email' => 'required|email|string|unique:subscribers,email'
        ]);

        // Create a new subscriber using the validated data
        Subscriber::create($validate);

        // Redirect to the 'theme.home' route with a success message
        return back()->with('subscriber.success', 'You have successfully subscribed.');
    }
}
