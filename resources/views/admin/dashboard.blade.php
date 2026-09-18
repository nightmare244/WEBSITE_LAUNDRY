@extends('layouts.app')

@section('body')

<div class="min-h-screen bg-slate-50 lg:flex">

    {{-- =========================================================
        SIDEBAR ADMIN
    ========================================================== --}}
    <aside class="no-print hidden w-72 shrink-0 flex-col bg-[#10243e] p-7 text-white lg:flex">

        {{-- Logo --}}
        <a href="{{ route('admin.orders.index') }}"
           class="flex items-center gap-3 text-xl font-black tracking-tight">

            <span class="grid h-10 w-10 place-items-center rounded-2xl bg-cyan-400 text-[#10243e]">
                KL
            </span>

            Kang Laundry
        </a>

        {{-- Workspace --}}
        <div class="mt-16 text-xs font-bold uppercase tracking-[.2em] text-cyan-200">
            Workspace
        </div>

        <nav class="mt-4 space-y-2">

            <a href="{{ route('admin.orders.index') }}"
               class="flex items-center gap-3 rounded-xl bg-white/10 px-4 py-3 font-semibold text-cyan-200">
                <span>◈</span>
                <span>Pesanan Aktif</span>
            </a>

            <a href="{{ route('track') }}"
               target="_blank"
               class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 transition hover:bg-white/10">
                <span>⌁</span>
                <span>Tracking Publik</span>
            </a>

        </nav>

        {{-- Tarif --}}
        <div class="mt-auto rounded-2xl border border-white/10 bg-white/5 p-4 text-sm text-slate-300">

            <div class="mb-2 text-cyan-300">
                Tarif saat ini
            </div>

            <strong class="text-2xl text-white">
                Rp {{ number_format(config('laundry.rate'), 0, ',', '.') }}
            </strong>

            <span>
                / kg
            </span>

        </div>

    </aside>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <main class="min-w-0 flex-1">

        {{-- HEADER --}}
        <header class="no-print border-b border-slate-200 bg-white px-5 py-5 sm:px-8">

            <div class="mx-auto flex max-w-7xl items-center justify-between gap-4">

                <div>

                    <p class="text-sm font-bold text-cyan-600">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </p>

                    <h1 class="mt-1 text-2xl font-black tracking-tight text-[#10243e] sm:text-3xl">
                        Ringkasan Pesanan
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Kelola seluruh pesanan laundry dari dashboard admin.
                    </p>

                </div>

                <a href="{{ route('admin.orders.create') }}"
                   class="shrink-0 rounded-xl bg-cyan-500 px-4 py-3 text-sm font-extrabold text-white shadow-lg shadow-cyan-500/20 transition hover:bg-cyan-600">

                    + Pesanan Baru

                </a>

            </div>

        </header>


        {{-- CONTENT --}}
        <div class="mx-auto max-w-7xl space-y-7 p-5 sm:p-8">


            {{-- =====================================================
                FLASH MESSAGE
            ====================================================== --}}
            @if(session('success'))

                <div class="no-print rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">

                    <div class="flex items-center gap-2">

                        <span class="text-lg">
                            ✓
                        </span>

                        {{ session('success') }}

                    </div>

                </div>

            @endif


            {{-- VALIDATION ERROR --}}
            @if($errors->any())

                <div class="no-print rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">

                    <p class="font-bold">
                        Terjadi kesalahan:
                    </p>

                    <ul class="mt-2 list-inside list-disc">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- =====================================================
                STATISTICS
            ====================================================== --}}

            @php

                $totalOrders = \App\Models\Order::count();

                $processingOrders = \App\Models\Order::whereIn('status', [
                    'received',
                    'washing',
                    'drying',
                    'ironing'
                ])->count();

                $readyOrders = \App\Models\Order::where('status', 'ready')->count();

                $totalRevenue = \App\Models\Order::sum('total_price');

            @endphp


            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">


                {{-- Total Order --}}
                <div class="rounded-2xl bg-[#10243e] p-5 text-white shadow-sm">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm text-slate-300">
                                Total Order
                            </p>

                            <p class="mt-3 text-3xl font-black">
                                {{ $totalOrders }}
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Semua pesanan
                            </p>

                        </div>

                        <div class="rounded-xl bg-white/10 px-3 py-2 text-xl">
                            🧺
                        </div>

                    </div>

                </div>


                {{-- Diproses --}}
                <div class="rounded-2xl border border-amber-100 bg-amber-50 p-5 shadow-sm">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-semibold text-amber-700">
                                Cucian Diproses
                            </p>

                            <p class="mt-3 text-3xl font-black text-[#10243e]">
                                {{ $processingOrders }}
                            </p>

                            <p class="mt-1 text-xs text-amber-600">
                                Sedang dikerjakan
                            </p>

                        </div>

                        <div class="rounded-xl bg-amber-100 p-3 text-xl text-amber-600">
                            ⟳
                        </div>

                    </div>

                </div>


                {{-- Ready --}}
                <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-5 shadow-sm">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-semibold text-emerald-700">
                                Siap Diambil
                            </p>

                            <p class="mt-3 text-3xl font-black text-[#10243e]">
                                {{ $readyOrders }}
                            </p>

                            <p class="mt-1 text-xs text-emerald-600">
                                Menunggu pelanggan
                            </p>

                        </div>

                        <div class="rounded-xl bg-emerald-100 p-3 text-xl text-emerald-600">
                            ✓
                        </div>

                    </div>

                </div>


                {{-- Revenue --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-semibold text-slate-500">
                                Total Pendapatan
                            </p>

                            <p class="mt-3 text-2xl font-black text-[#10243e]">
                                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Dari seluruh order
                            </p>

                        </div>

                        <div class="rounded-xl bg-cyan-50 p-3 text-xl text-cyan-600">
                            💰
                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                INPUT ORDER ADMIN
            ====================================================== --}}

            <section class="grid gap-6 lg:grid-cols-3">


                {{-- FORM --}}
                <div class="h-fit rounded-2xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-1">

                    <div class="mb-5">

                        <div class="flex items-center gap-2">

                            <div class="grid h-10 w-10 place-items-center rounded-xl bg-cyan-50 text-cyan-600">
                                +
                            </div>

                            <div>

                                <h2 class="text-lg font-black text-[#10243e]">
                                    Input Order Baru
                                </h2>

                                <p class="text-xs text-slate-400">
                                    Tambahkan pesanan pelanggan
                                </p>

                            </div>

                        </div>

                    </div>


                    <form
                        method="POST"
                        action="{{ route('admin.orders.store') }}"
                        class="space-y-4"
                    >

                        @csrf


                        {{-- Nama --}}
                        <div>

                            <label class="mb-1 block text-sm font-bold text-slate-600">
                                Nama Pelanggan
                            </label>

                            <input
                                type="text"
                                name="customer_name"
                                value="{{ old('customer_name') }}"
                                required
                                maxlength="120"
                                placeholder="Contoh: Budi"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-2 focus:ring-cyan-100"
                            >

                        </div>


                        {{-- WhatsApp --}}
                        <div>

                            <label class="mb-1 block text-sm font-bold text-slate-600">
                                No. WhatsApp
                            </label>

                            <input
                                type="text"
                                name="whatsapp_number"
                                value="{{ old('whatsapp_number') }}"
                                required
                                maxlength="20"
                                placeholder="628123456789"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-2 focus:ring-cyan-100"
                            >

                            <p class="mt-1 text-xs text-slate-400">
                                Gunakan format 628xxx
                            </p>

                        </div>


                        {{-- Berat --}}
                        <div>

                            <label class="mb-1 block text-sm font-bold text-slate-600">
                                Berat Laundry
                            </label>

                            <div class="relative">

                                <input
                                    type="number"
                                    name="weight"
                                    id="weightInput"
                                    value="{{ old('weight') }}"
                                    required
                                    min="0.1"
                                    max="9999"
                                    step="0.1"
                                    placeholder="0"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 pr-12 text-sm outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-2 focus:ring-cyan-100"
                                >

                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-400">
                                    Kg
                                </span>

                            </div>

                        </div>


                        {{-- Total --}}
                        <div>

                            <label class="mb-1 block text-sm font-bold text-slate-600">
                                Total Bayar
                            </label>

                            <div
                                id="totalOutput"
                                class="rounded-xl border border-cyan-100 bg-cyan-50 px-4 py-3 text-xl font-black text-[#10243e]"
                            >
                                Rp 0
                            </div>

                            <p class="mt-1 text-xs text-slate-400">
                                Tarif:
                                Rp {{ number_format(config('laundry.rate'), 0, ',', '.') }}/kg
                            </p>

                        </div>


                        {{-- Estimasi --}}
                        <div>

                            <label class="mb-1 block text-sm font-bold text-slate-600">
                                Estimasi Selesai
                            </label>

                            <input
                                type="datetime-local"
                                name="estimated_ready_at"
                                value="{{ old('estimated_ready_at') }}"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-2 focus:ring-cyan-100"
                            >

                        </div>


                        {{-- Submit --}}
                        <button
                            type="submit"
                            class="w-full rounded-xl bg-cyan-500 px-4 py-3 font-extrabold text-white shadow-lg shadow-cyan-500/20 transition hover:bg-cyan-600 active:scale-[.98]"
                        >

                            <span class="flex items-center justify-center gap-2">
                                ✓
                                Simpan Order
                            </span>

                        </button>

                    </form>

                </div>


                {{-- =================================================
                    ORDER LIST
                ================================================== --}}

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:col-span-2">

                    {{-- Header --}}
                    <div class="border-b border-slate-100 p-5">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>

                                <h2 class="text-lg font-black text-[#10243e]">
                                    Daftar Cucian
                                </h2>

                                <p class="mt-1 text-xs text-slate-400">
                                    Kelola status dan detail pesanan
                                </p>

                            </div>

                            <div class="rounded-lg bg-cyan-50 px-3 py-2 text-xs font-bold text-cyan-700">

                                {{ $orders->total() }} order

                            </div>

                        </div>

                    </div>


                    {{-- Search --}}
                    <form
                        method="GET"
                        class="no-print flex flex-col gap-3 border-b border-slate-100 bg-slate-50/50 p-4 sm:flex-row"
                    >

                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Cari nama atau kode order..."
                            class="min-w-0 flex-1 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100"
                        >


                        <select
                            name="status"
                            class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-cyan-500"
                        >

                            <option value="">
                                Semua Status
                            </option>

                            @foreach(config('laundry.statuses') as $key => $label)

                                <option
                                    value="{{ $key }}"
                                    @selected($status === $key)
                                >
                                    {{ $label }}
                                </option>

                            @endforeach

                        </select>


                        <button
                            type="submit"
                            class="rounded-xl bg-[#10243e] px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800"
                        >
                            Cari
                        </button>

                    </form>


                    {{-- TABLE --}}
                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[1000px] text-left text-sm">

                            <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">

                                <tr>

                                    <th class="px-5 py-4">
                                        Pesanan
                                    </th>

                                    <th class="px-5 py-4">
                                        Pelanggan
                                    </th>

                                    <th class="px-5 py-4">
                                        Detail
                                    </th>

                                    <th class="px-5 py-4">
                                        Status
                                    </th>

                                    <th class="px-5 py-4">
                                        Estimasi
                                    </th>

                                    <th class="px-5 py-4 text-right">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-slate-100">


                                @forelse($orders as $order)

                                    @php

                                        $statusColors = [
                                            'received' => 'bg-slate-100 text-slate-700',
                                            'washing' => 'bg-amber-100 text-amber-700',
                                            'drying' => 'bg-sky-100 text-sky-700',
                                            'ironing' => 'bg-purple-100 text-purple-700',
                                            'ready' => 'bg-emerald-100 text-emerald-700',
                                        ];

                                        $statusColor = $statusColors[$order->status]
                                            ?? 'bg-slate-100 text-slate-700';

                                    @endphp


                                    <tr class="transition hover:bg-cyan-50/30">


                                        {{-- ORDER --}}
                                        <td class="px-5 py-5">

                                            <div class="font-black text-cyan-600">
                                                {{ $order->order_code }}
                                            </div>

                                            <div class="mt-1 text-xs text-slate-400">
                                                {{ $order->created_at->format('d M Y, H:i') }}
                                            </div>

                                        </td>


                                        {{-- CUSTOMER --}}
                                        <td class="px-5 py-5">

                                            <div class="font-bold text-[#10243e]">
                                                {{ $order->customer_name }}
                                            </div>

                                            <div class="mt-1 text-xs text-slate-400">
                                                +{{ $order->whatsapp_number }}
                                            </div>

                                        </td>


                                        {{-- DETAIL --}}
                                        <td class="px-5 py-5">

                                            <div class="font-bold text-slate-700">
                                                {{ number_format((float) $order->weight, 2, ',', '.') }}
                                                Kg
                                            </div>

                                            <div class="mt-1 font-black text-[#10243e]">
                                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                            </div>

                                        </td>


                                        {{-- STATUS --}}
                                        <td class="px-5 py-5">

                                            <form
                                                method="POST"
                                                action="{{ route('admin.orders.status', $order) }}"
                                            >

                                                @csrf

                                                @method('PATCH')


                                                <select
                                                    name="status"
                                                    onchange="this.form.submit()"
                                                    class="rounded-lg border-0 px-3 py-2 text-xs font-bold {{ $statusColor }} focus:ring-2 focus:ring-cyan-400"
                                                >

                                                    @foreach(config('laundry.statuses') as $key => $label)

                                                        <option
                                                            value="{{ $key }}"
                                                            @selected($order->status === $key)
                                                        >
                                                            {{ $label }}
                                                        </option>

                                                    @endforeach

                                                </select>

                                            </form>

                                        </td>


                                        {{-- ESTIMATED --}}
                                        <td class="px-5 py-5">

                                            @if($order->estimated_ready_at)

                                                <div class="font-semibold text-slate-700">

                                                    {{ $order->estimated_ready_at->format('d M Y') }}

                                                </div>

                                                <div class="mt-1 text-xs text-slate-400">

                                                    {{ $order->estimated_ready_at->format('H:i') }}
                                                    WIB

                                                </div>

                                            @else

                                                <span class="text-xs text-slate-400">
                                                    Belum ditentukan
                                                </span>

                                            @endif

                                        </td>


                                        {{-- ACTION --}}
                                        <td class="px-5 py-5">

                                            <div class="flex justify-end gap-2">


                                                {{-- EDIT --}}
                                                <a
                                                    href="{{ route('admin.orders.edit', $order) }}"
                                                    class="rounded-lg bg-cyan-50 px-3 py-2 text-xs font-bold text-cyan-700 transition hover:bg-cyan-100"
                                                    title="Edit Detail"
                                                >
                                                    ✎ Edit
                                                </a>


                                                {{-- WHATSAPP --}}
                                                <button
                                                    type="button"
                                                    onclick='notifyCustomer(
                                                        @json($order->whatsapp_number),
                                                        @json($order->customer_name),
                                                        @json($order->order_code),
                                                        @json($order->status_label),
                                                        @json(optional($order->estimated_ready_at)->format("d M Y, H:i") ?? "akan diinformasikan")
                                                    )'
                                                    class="rounded-lg bg-emerald-50 px-3 py-2 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100"
                                                    title="Kirim WhatsApp"
                                                >
                                                    WA
                                                </button>


                                                {{-- RECEIPT --}}
                                                <a
                                                    href="{{ route('admin.orders.receipt', $order) }}"
                                                    target="_blank"
                                                    class="rounded-lg bg-slate-100 px-3 py-2 text-xs font-bold text-slate-700 transition hover:bg-slate-200"
                                                    title="Cetak Nota"
                                                >
                                                    Nota
                                                </a>


                                                {{-- ARCHIVE --}}
                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.orders.destroy', $order) }}"
                                                    onsubmit="return confirm('Arsipkan pesanan {{ $order->order_code }}?')"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="rounded-lg bg-rose-50 px-3 py-2 text-xs font-bold text-rose-600 transition hover:bg-rose-100"
                                                        title="Arsipkan"
                                                    >
                                                        Arsip
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td
                                            colspan="6"
                                            class="px-5 py-20 text-center"
                                        >

                                            <div class="mx-auto max-w-sm">

                                                <div class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-slate-100 text-3xl">
                                                    🧺
                                                </div>

                                                <p class="mt-4 font-bold text-slate-600">
                                                    Belum ada pesanan
                                                </p>

                                                <p class="mt-1 text-sm text-slate-400">
                                                    Pesanan yang dibuat akan muncul di sini.
                                                </p>

                                            </div>

                                        </td>

                                    </tr>

                                @endforelse


                            </tbody>

                        </table>

                    </div>


                    {{-- PAGINATION --}}
                    @if($orders->hasPages())

                        <div class="no-print border-t border-slate-100 p-4">

                            {{ $orders->links() }}

                        </div>

                    @endif

                </div>

            </section>

        </div>

    </main>

</div>


@endsection


{{-- =============================================================
    JAVASCRIPT
============================================================= --}}

@push('scripts')

<script>

    /*
    |--------------------------------------------------------------------------
    | HITUNG TOTAL HARGA
    |--------------------------------------------------------------------------
    */

    const weightInput = document.getElementById('weightInput');
    const totalOutput = document.getElementById('totalOutput');

    const laundryRate = {{ (int) config('laundry.rate') }};


    if (weightInput && totalOutput) {

        function calculateTotal() {

            const weight = parseFloat(weightInput.value) || 0;

            const total = Math.ceil(weight * laundryRate);

            totalOutput.textContent =
                'Rp ' + total.toLocaleString('id-ID');

        }


        weightInput.addEventListener(
            'input',
            calculateTotal
        );


        calculateTotal();

    }


    /*
    |--------------------------------------------------------------------------
    | WHATSAPP
    |--------------------------------------------------------------------------
    */

    function notifyCustomer(
        phone,
        name,
        code,
        status,
        ready
    ) {

        phone = String(phone).replace(/\D/g, '');

        const message =
            `Halo ${name},\n\n` +
            `Update pesanan Kang Laundry\n\n` +
            `Kode Order: ${code}\n` +
            `Status: ${status}\n` +
            `Estimasi siap: ${ready}\n\n` +
            `Terima kasih.\n` +
            `Kang Laundry`;


        const url =
            `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;


        window.open(
            url,
            '_blank'
        );

    }

</script>

@endpush