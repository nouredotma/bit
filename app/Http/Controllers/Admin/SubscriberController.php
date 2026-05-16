<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = NewsletterSubscriber::latest()->paginate(20);
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function destroy($id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->delete();

        return redirect()->route('admin.subscribers.index')->with('success', 'Subscriber deleted successfully.');
    }
}
