<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * ============================================================
     * ADMIN - DASHBOARD
     * ============================================================
     */
    public function index(Request $request): View
    {
        $search = $request
            ->string('search')
            ->trim()
            ->toString();

        $status = $request
            ->string('status')
            ->toString();

        $orders = Order::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where(
                        'order_code',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'customer_name',
                        'like',
                        "%{$search}%"
                    );
                });
            })
            ->when(
                array_key_exists(
                    $status,
                    config('laundry.statuses')
                ),
                function ($query) use ($status) {
                    $query->where(
                        'status',
                        $status
                    );
                }
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.dashboard',
            compact(
                'orders',
                'search',
                'status'
            )
        );
    }


    /**
     * ============================================================
     * ADMIN - FORM CREATE ORDER
     * ============================================================
     */
    public function create(): View
    {
        return view(
            'admin.orders.create'
        );
    }


    /**
     * ============================================================
     * ADMIN - STORE ORDER
     * ============================================================
     */
    public function store(
        Request $request
    ): RedirectResponse {
        $data = $request->validate([
            'customer_name' => [
                'required',
                'string',
                'max:120',
            ],

            'whatsapp_number' => [
                'required',
                'string',
                'max:20',
            ],

            'weight' => [
                'required',
                'numeric',
                'min:0.1',
                'max:9999',
            ],

            'estimated_ready_at' => [
                'nullable',
                'date',
            ],
        ]);


        // Bersihkan nomor WhatsApp
        $data['whatsapp_number'] = preg_replace(
            '/\D+/',
            '',
            $data['whatsapp_number']
        );


        // Generate kode order unik
        do {
            $data['order_code'] =
                'KL-' . strtoupper(
                    Str::random(7)
                );
        } while (
            Order::where(
                'order_code',
                $data['order_code']
            )->exists()
        );


        // Hitung total harga
        $data['total_price'] =
            (int) ceil(
                $data['weight']
                * config('laundry.rate')
            );


        // Status awal
        $data['status'] = 'received';


        // Simpan order
        Order::create($data);


        return redirect()
            ->route('admin.orders.index')
            ->with(
                'success',
                'Pesanan berhasil dibuat.'
            );
    }


    /**
     * ============================================================
     * PUBLIC USER - STORE ORDER
     * ============================================================
     *
     * User tidak perlu login untuk membuat pesanan.
     */
    public function storePublic(
        Request $request
    ): RedirectResponse {
        $data = $request->validate([
            'customer_name' => [
                'required',
                'string',
                'max:120',
            ],

            'whatsapp_number' => [
                'required',
                'string',
                'max:20',
            ],

            'weight' => [
                'required',
                'numeric',
                'min:0.1',
                'max:9999',
            ],
        ]);


        // Bersihkan nomor WhatsApp
        $data['whatsapp_number'] = preg_replace(
            '/\D+/',
            '',
            $data['whatsapp_number']
        );


        // Generate kode order unik
        do {
            $data['order_code'] =
                'KL-' . strtoupper(
                    Str::random(7)
                );
        } while (
            Order::where(
                'order_code',
                $data['order_code']
            )->exists()
        );


        // Hitung total harga
        $data['total_price'] =
            (int) ceil(
                $data['weight']
                * config('laundry.rate')
            );


        // Status awal
        $data['status'] = 'received';


        // Estimasi selesai belum ditentukan
        $data['estimated_ready_at'] = null;


        // Simpan order
        $order = Order::create($data);


        /*
        |--------------------------------------------------------------------------
        | Kembali ke halaman user
        |--------------------------------------------------------------------------
        |
        | Setelah order dibuat, user langsung melihat
        | detail dan kode order.
        |
        */
        return redirect()
            ->route(
                'user.order',
                [
                    'order_code' =>
                        $order->order_code,
                ]
            )
            ->with(
                'success',
                'Pesanan berhasil dibuat. Simpan kode pesanan kamu.'
            );
    }


    /**
     * ============================================================
     * ADMIN - FORM EDIT ORDER
     * ============================================================
     */
    public function edit(
        Order $order
    ): View {
        return view(
            'admin.orders.edit',
            compact('order')
        );
    }


    /**
     * ============================================================
     * ADMIN - UPDATE ORDER
     * ============================================================
     */
    public function update(
        Request $request,
        Order $order
    ): RedirectResponse {
        $data = $request->validate([
            'customer_name' => [
                'required',
                'string',
                'max:120',
            ],

            'whatsapp_number' => [
                'required',
                'string',
                'max:20',
            ],

            'weight' => [
                'required',
                'numeric',
                'min:0.1',
                'max:9999',
            ],

            'status' => [
                'required',
                'in:received,washing,drying,ironing,ready',
            ],

            'estimated_ready_at' => [
                'nullable',
                'date',
            ],
        ]);


        // Bersihkan nomor WhatsApp
        $data['whatsapp_number'] = preg_replace(
            '/\D+/',
            '',
            $data['whatsapp_number']
        );


        // Hitung ulang harga berdasarkan berat
        $data['total_price'] =
            (int) ceil(
                $data['weight']
                * config('laundry.rate')
            );


        /*
        |--------------------------------------------------------------------------
        | Update order
        |--------------------------------------------------------------------------
        |
        | order_code tidak dimasukkan ke $data.
        | Jadi kode order tidak dapat berubah.
        |
        */
        $order->update($data);


        return redirect()
            ->route('admin.orders.index')
            ->with(
                'success',
                'Detail pesanan berhasil diperbarui.'
            );
    }


    /**
     * ============================================================
     * ADMIN - UPDATE STATUS
     * ============================================================
     */
    public function updateStatus(
        Request $request,
        Order $order
    ): RedirectResponse {
        $data = $request->validate([
            'status' => [
                'required',
                'in:received,washing,drying,ironing,ready',
            ],
        ]);


        $order->update([
            'status' => $data['status'],
        ]);


        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );
    }


    /**
     * ============================================================
     * ADMIN - ARCHIVE ORDER
     * ============================================================
     */
    public function destroy(
        Order $order
    ): RedirectResponse {
        $order->delete();


        return back()->with(
            'success',
            'Pesanan dipindahkan ke arsip.'
        );
    }


    /**
     * ============================================================
     * PUBLIC USER - TRACKING PAGE
     * ============================================================
     */
    public function track(
        Request $request
    ): View {
        $order = null;


        if ($request->filled('order_code')) {

            $order = Order::where(
                'order_code',
                strtoupper(
                    $request
                        ->string('order_code')
                        ->trim()
                        ->toString()
                )
            )->first();
        }


        /*
        |--------------------------------------------------------------------------
        | Gunakan UI user
        |--------------------------------------------------------------------------
        */
        return view(
            'users.order',
            compact('order')
        );
    }


    /**
     * ============================================================
     * PUBLIC USER - REALTIME TRACKING DATA
     * ============================================================
     */
    public function trackingData(
        Order $order
    ) {
        return response()->json([
            'order_code' =>
                $order->order_code,

            'customer_name' =>
                $order->customer_name,

            'whatsapp_number' =>
                $order->whatsapp_number,

            'weight' =>
                $order->weight,

            'total_price' =>
                $order->total_price,

            'status' =>
                $order->status,

            'status_label' =>
                $order->status_label,

            'progress_percent' =>
                $order->progress_percent,

            'estimated_ready_at' =>
                $order->estimated_ready_at
                    ? $order->estimated_ready_at->format(
                        'Y-m-d H:i:s'
                    )
                    : null,
        ]);
    }


    /**
     * ============================================================
     * ADMIN - RECEIPT
     * ============================================================
     */
    public function receipt(
        Order $order
    ): View {
        return view(
            'admin.orders.receipt',
            compact('order')
        );
    }
}