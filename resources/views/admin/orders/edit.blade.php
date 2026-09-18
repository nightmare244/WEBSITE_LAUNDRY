@extends('layouts.app')

@section('body')

<div class="min-h-screen bg-slate-50">

    {{-- HEADER --}}
    <header class="border-b border-slate-200 bg-white px-5 py-5 sm:px-8">

        <div class="mx-auto flex max-w-5xl items-center justify-between gap-4">

            <div>
                <p class="text-sm font-bold text-cyan-600">
                    Kang Laundry
                </p>

                <h1 class="mt-1 text-2xl font-black tracking-tight text-[#10243e] sm:text-3xl">
                    Edit Pesanan
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Perbarui informasi pesanan pelanggan.
                </p>
            </div>

            <a
                href="{{ route('admin.orders.index') }}"
                class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-extrabold text-slate-700 shadow-sm transition hover:border-cyan-300 hover:text-cyan-600"
            >
                ← Kembali
            </a>

        </div>

    </header>


    {{-- CONTENT --}}
    <main class="mx-auto max-w-5xl px-5 py-8 sm:px-8">

        {{-- VALIDATION ERROR --}}
        @if($errors->any())

            <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-4 text-sm text-rose-700">

                <p class="font-bold">
                    Terjadi kesalahan:
                </p>

                <ul class="mt-2 list-inside list-disc">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif


        {{-- FORM CARD --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

            {{-- FORM HEADER --}}
            <div class="mb-7 flex items-center gap-3">

                <div class="grid h-12 w-12 place-items-center rounded-2xl bg-cyan-50 text-cyan-600">
                    ✎
                </div>

                <div>

                    <h2 class="text-xl font-black text-[#10243e]">
                        Informasi Pesanan
                    </h2>

                    <p class="text-sm text-slate-400">
                        Kode pesanan:
                        <span class="font-bold text-slate-600">
                            {{ $order->order_code }}
                        </span>
                    </p>

                </div>

            </div>


            {{-- FORM --}}
            <form
                method="POST"
                action="{{ route('admin.orders.update', $order, false) }}"
                class="space-y-6"
            >

                @csrf
                @method('PUT')


                {{-- NAMA PELANGGAN --}}
                <div>

                    <label
                        for="customer_name"
                        class="mb-2 block text-sm font-bold text-slate-600"
                    >
                        Nama Pelanggan
                    </label>

                    <input
                        type="text"
                        id="customer_name"
                        name="customer_name"
                        value="{{ old('customer_name', $order->customer_name) }}"
                        required
                        maxlength="120"
                        placeholder="Contoh: Budi"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-2 focus:ring-cyan-100"
                    >

                </div>


                {{-- WHATSAPP --}}
                <div>

                    <label
                        for="whatsapp_number"
                        class="mb-2 block text-sm font-bold text-slate-600"
                    >
                        No. WhatsApp
                    </label>

                    <input
                        type="text"
                        id="whatsapp_number"
                        name="whatsapp_number"
                        value="{{ old('whatsapp_number', $order->whatsapp_number) }}"
                        required
                        maxlength="20"
                        placeholder="628123456789"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-2 focus:ring-cyan-100"
                    >

                    <p class="mt-1 text-xs text-slate-400">
                        Gunakan format 628xxx
                    </p>

                </div>


                {{-- BERAT --}}
                <div>

                    <label
                        for="weight"
                        class="mb-2 block text-sm font-bold text-slate-600"
                    >
                        Berat Laundry
                    </label>

                    <div class="relative">

                        <input
                            type="number"
                            id="weight"
                            name="weight"
                            value="{{ old('weight', $order->weight) }}"
                            required
                            min="0.1"
                            max="9999"
                            step="0.1"
                            placeholder="0"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 pr-14 text-sm outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-2 focus:ring-cyan-100"
                        >

                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-400">
                            Kg
                        </span>

                    </div>

                </div>


                {{-- TOTAL --}}
                <div>

                    <label class="mb-2 block text-sm font-bold text-slate-600">
                        Total Bayar
                    </label>

                    <div
                        id="totalOutput"
                        class="rounded-xl border border-cyan-100 bg-cyan-50 px-4 py-3 text-xl font-black text-[#10243e]"
                    >
                        Rp {{ number_format($order->total_price ?? 0, 0, ',', '.') }}
                    </div>

                    <p class="mt-1 text-xs text-slate-400">
                        Tarif:
                        Rp {{ number_format(config('laundry.rate'), 0, ',', '.') }}/kg
                    </p>

                </div>


                {{-- ESTIMASI SELESAI --}}
                <div>

                    <label
                        for="estimated_ready_at"
                        class="mb-2 block text-sm font-bold text-slate-600"
                    >
                        Estimasi Selesai
                    </label>

                    <input
                        type="datetime-local"
                        id="estimated_ready_at"
                        name="estimated_ready_at"
                        value="{{ old('estimated_ready_at', $order->estimated_ready_at ? \Carbon\Carbon::parse($order->estimated_ready_at)->format('Y-m-d\TH:i') : '') }}"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-2 focus:ring-cyan-100"
                    >

                </div>


                {{-- STATUS --}}
                <div>

                    <label
                        for="status"
                        class="mb-2 block text-sm font-bold text-slate-600"
                    >
                        Status Pesanan
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-2 focus:ring-cyan-100"
                    >

                        <option
                            value="received"
                            {{ old('status', $order->status) === 'received' ? 'selected' : '' }}
                        >
                            Received
                        </option>

                        <option
                            value="washing"
                            {{ old('status', $order->status) === 'washing' ? 'selected' : '' }}
                        >
                            Washing
                        </option>

                        <option
                            value="drying"
                            {{ old('status', $order->status) === 'drying' ? 'selected' : '' }}
                        >
                            Drying
                        </option>

                        <option
                            value="ironing"
                            {{ old('status', $order->status) === 'ironing' ? 'selected' : '' }}
                        >
                            Ironing
                        </option>

                        <option
                            value="ready"
                            {{ old('status', $order->status) === 'ready' ? 'selected' : '' }}
                        >
                            Ready
                        </option>

                    </select>

                </div>


                {{-- BUTTON --}}
                <div class="flex flex-col-reverse gap-3 pt-4 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-center text-sm font-extrabold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="rounded-xl bg-cyan-500 px-6 py-3 text-sm font-extrabold text-white shadow-lg shadow-cyan-500/20 transition hover:bg-cyan-600 active:scale-[.98]"
                    >
                        ✓ Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>


{{-- JAVASCRIPT --}}
<script>

    const laundryRate = {{ (int) config('laundry.rate') }};

    const weightInput = document.getElementById('weight');

    const totalOutput = document.getElementById('totalOutput');


    function formatRupiah(number) {

        return new Intl.NumberFormat(
            'id-ID',
            {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }
        ).format(number);

    }


    function updateTotal() {

        if (!weightInput || !totalOutput) {
            return;
        }

        const weight = parseFloat(weightInput.value) || 0;

        const total = Math.ceil(weight * laundryRate);

        totalOutput.textContent = formatRupiah(total);

    }


    if (weightInput) {

        weightInput.addEventListener(
            'input',
            updateTotal
        );

    }

</script>

@endsection