<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('shop.contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Log the contact message (can be replaced with Mail::send later)
        Log::info('Contact form submission', $validated);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your message has been sent.',
        ]);
    }
}
