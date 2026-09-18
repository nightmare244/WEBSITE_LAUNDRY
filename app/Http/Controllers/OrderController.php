<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();
        $status = $request->string('status')->toString();
        $orders = Order::query()
            ->when($search, fn ($query) => $query->where(fn ($q) => $q->where('order_code', 'like', "%{$search}%")->orWhere('customer_name', 'like', "%{$search}%")))
            ->when(array_key_exists($status, config('laundry.statuses')), fn ($query) => $query->where('status', $status))
            ->latest()->paginate(10)->withQueryString();

        return view('admin.dashboard', compact('orders', 'search', 'status'));
    }

    public function create(): View
    {
        return view('admin.orders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'whatsapp_number' => ['required', 'string', 'max:20'],
            'weight' => ['required', 'numeric', 'min:0.1', 'max:9999'],
            'estimated_ready_at' => ['nullable', 'date'],
        ]);
        $data['order_code'] = 'KL-'.strtoupper(Str::random(7));
        $data['total_price'] = (int) ceil($data['weight'] * config('laundry.rate'));
        $data['status'] = 'received';
        $data['whatsapp_number'] = preg_replace('/\D+/', '', $data['whatsapp_number']);
        Order::create($data);

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $data = $request->validate(['status' => ['required', 'in:received,washing,drying,ironing,ready']]);
        $order->update($data);
        return back()->with('success', 'Status pesanan diperbarui.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();
        return back()->with('success', 'Pesanan dipindahkan ke arsip.');
    }

    public function track(Request $request): View
    {
        $order = $request->filled('order_code')
            ? Order::where('order_code', strtoupper($request->string('order_code')))->first()
            : null;
        return view('track', compact('order'));
    }

    public function receipt(Order $order): View
    {
        return view('admin.orders.receipt', compact('order'));
    }
}
