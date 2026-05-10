<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            'totalRevenue' => Order::sum('total'),
            'totalCategories' => Category::count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'lowStock' => Product::where('stock', '<', 10)->count(),
        ];

        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }

    public function loginPage()
    {
        if (session('admin')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            $request->session()->regenerate();
            session(['admin' => $admin->id]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        session()->forget('admin');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
