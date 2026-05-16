<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $existing = NewsletterSubscriber::where('email', $validated['email'])->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'This email already we have it',
            ]);
        }

        NewsletterSubscriber::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'You have been subscribed successfully!',
        ]);
    }
}
