<?php

namespace App\Http\Controllers;

use App\Models\BlogRequest;
use Illuminate\Support\Facades\Auth;

class BlogRequestController extends Controller
{
    public function sendRequest()
    {
        // Check if the user has already sent  request
        $user = Auth::user();
        $existingRequest = BlogRequest::where('user_id', $user->id)->first();

        if (!$existingRequest) {
            // Create  new request
            BlogRequest::create(['user_id' => $user->id]);

            return redirect()->back()->with('success', 'Request sent successfully.');
        }

        return redirect()->back()->with('error', 'Request already sent.');
    }
}

