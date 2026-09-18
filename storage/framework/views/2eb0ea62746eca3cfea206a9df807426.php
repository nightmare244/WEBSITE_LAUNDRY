<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Kang Laundry - Pesan & Tracking</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    >

    <style>

        body {
            font-family: 'Inter', sans-serif;
        }

        .grid-bg {
            background-color: #f8fafc;

            background-image:
                linear-gradient(
                    rgba(14, 165, 233, 0.08) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(14, 165, 233, 0.08) 1px,
                    transparent 1px
                );

            background-size: 36px 36px;
        }

        .status-line {
            transition: width 0.6s ease;
        }

    </style>

</head>


<body class="grid-bg min-h-screen text-slate-900">


    

    <header class="relative z-20">

        <div class="max-w-7xl mx-auto px-6 py-6">

            <div class="flex items-center justify-between">

                

                <a
                    href="<?php echo e(route('user.order')); ?>"
                    class="flex items-center gap-3"
                >

                    <div
                        class="w-12 h-12 rounded-2xl bg-cyan-500 text-white flex items-center justify-center font-black shadow-lg shadow-cyan-500/20"
                    >
                        KL
                    </div>

                    <div>

                        <div class="text-xl font-black tracking-tight">
                            Kang Laundry
                        </div>

                        <div class="text-xs text-slate-500">
                            Laundry cepat & terpercaya
                        </div>

                    </div>

                </a>


                

                <a
                    href="<?php echo e(route('admin.login')); ?>"
                    class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-800 shadow-sm hover:border-cyan-300 hover:text-cyan-600 transition"
                >
                    Admin Desk
                </a>

            </div>

        </div>

    </header>



    

    <main class="relative">

        <div class="max-w-7xl mx-auto px-6 pt-12 pb-20">


            

            <div class="max-w-3xl mb-12">

                <div
                    class="inline-flex items-center rounded-full bg-cyan-100 px-4 py-2 text-xs font-black uppercase tracking-widest text-cyan-700"
                >
                    Laundry Online
                </div>

                <h1
                    class="mt-6 text-5xl md:text-7xl font-black tracking-tight leading-[0.95]"
                >

                    Cucianmu,

                    <span class="block text-cyan-500">
                        kami urus.
                    </span>

                </h1>

                <p
                    class="mt-6 text-lg md:text-xl text-slate-600 max-w-2xl leading-relaxed"
                >
                    Buat pesanan laundry tanpa login dan pantau
                    proses cucian kamu secara real-time menggunakan
                    kode pesanan.
                </p>

            </div>



            

            <?php if(session('success')): ?>

                <div
                    class="mb-8 rounded-2xl border border-green-200 bg-green-50 p-5"
                >

                    <div class="flex items-start gap-4">

                        <div
                            class="w-10 h-10 rounded-xl bg-green-500 text-white flex items-center justify-center font-bold"
                        >
                            ✓
                        </div>

                        <div>

                            <p class="font-bold text-green-800">
                                Pesanan berhasil dibuat
                            </p>

                            <p class="mt-1 text-sm text-green-700">
                                <?php echo e(session('success')); ?>

                            </p>

                            <?php if($order): ?>

                                <p class="mt-3 text-sm text-green-800">
                                    Kode pesanan kamu:
                                    <strong class="font-black">
                                        <?php echo e($order->order_code); ?>

                                    </strong>
                                </p>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            <?php endif; ?>



            

            <?php if($errors->any()): ?>

                <div
                    class="mb-8 rounded-2xl border border-red-200 bg-red-50 p-5"
                >

                    <p class="font-bold text-red-800">
                        Pesanan belum dapat dibuat
                    </p>

                    <ul class="mt-2 list-disc list-inside text-sm text-red-700">

                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <li>
                                <?php echo e($error); ?>

                            </li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>

                </div>

            <?php endif; ?>



            

            <div
                class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start"
            >


                

                <section
                    class="rounded-3xl bg-white border border-slate-200 shadow-xl shadow-slate-200/40 overflow-hidden"
                >

                    <div class="p-7 md:p-9">

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <p
                                    class="text-xs font-black uppercase tracking-widest text-cyan-600"
                                >
                                    New Order
                                </p>

                                <h2
                                    class="mt-2 text-2xl font-black"
                                >
                                    Buat Pesanan
                                </h2>

                                <p
                                    class="mt-2 text-sm text-slate-500"
                                >
                                    Isi data berikut untuk membuat
                                    pesanan laundry.
                                </p>

                            </div>

                            <div
                                class="w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center"
                            >

                                <svg
                                    class="w-6 h-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7M8 11h8M9 15h6"
                                    />

                                </svg>

                            </div>

                        </div>



                        <form
                            action="<?php echo e(route('user.order.store')); ?>"
                            method="POST"
                            class="mt-8 space-y-6"
                        >

                            <?php echo csrf_field(); ?>


                            

                            <div>

                                <label
                                    for="customer_name"
                                    class="block text-sm font-bold text-slate-700 mb-2"
                                >
                                    Nama Lengkap
                                </label>

                                <input
                                    type="text"
                                    id="customer_name"
                                    name="customer_name"
                                    value="<?php echo e(old('customer_name')); ?>"
                                    required
                                    maxlength="120"
                                    placeholder="Contoh: Mohammad Nasrulloh"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none transition focus:border-cyan-400 focus:bg-white focus:ring-4 focus:ring-cyan-400/10"
                                >

                            </div>



                            

                            <div>

                                <label
                                    for="whatsapp_number"
                                    class="block text-sm font-bold text-slate-700 mb-2"
                                >
                                    Nomor WhatsApp
                                </label>

                                <input
                                    type="tel"
                                    id="whatsapp_number"
                                    name="whatsapp_number"
                                    value="<?php echo e(old('whatsapp_number')); ?>"
                                    required
                                    maxlength="20"
                                    placeholder="Contoh: 0878xxxxxxxx"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none transition focus:border-cyan-400 focus:bg-white focus:ring-4 focus:ring-cyan-400/10"
                                >

                                <p class="mt-2 text-xs text-slate-400">
                                    Nomor ini digunakan untuk menghubungi
                                    kamu mengenai pesanan.
                                </p>

                            </div>



                            

                            <div>

                                <label
                                    for="weight"
                                    class="block text-sm font-bold text-slate-700 mb-2"
                                >
                                    Berat Laundry
                                </label>

                                <div class="relative">

                                    <input
                                        type="number"
                                        id="weight"
                                        name="weight"
                                        value="<?php echo e(old('weight')); ?>"
                                        required
                                        min="0.1"
                                        max="9999"
                                        step="0.1"
                                        placeholder="Contoh: 3.5"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 pr-16 outline-none transition focus:border-cyan-400 focus:bg-white focus:ring-4 focus:ring-cyan-400/10"
                                    >

                                    <span
                                        class="absolute right-5 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-400"
                                    >
                                        Kg
                                    </span>

                                </div>

                            </div>



                            

                            <div
                                class="rounded-2xl bg-slate-900 p-5 text-white"
                            >

                                <div class="flex items-center justify-between">

                                    <span class="text-sm text-slate-400">
                                        Estimasi harga
                                    </span>

                                    <span
                                        id="pricePreview"
                                        class="text-2xl font-black"
                                    >
                                        Rp 0
                                    </span>

                                </div>

                                <div
                                    class="mt-2 text-xs text-slate-500"
                                >
                                    Tarif:
                                    Rp <?php echo e(number_format(config('laundry.rate'), 0, ',', '.')); ?>

                                    / Kg
                                </div>

                            </div>



                            

                            <button
                                type="submit"
                                class="w-full rounded-2xl bg-cyan-500 px-6 py-4 text-sm font-black text-white shadow-lg shadow-cyan-500/20 transition hover:bg-cyan-600 hover:-translate-y-0.5 active:translate-y-0"
                            >
                                Buat Pesanan
                            </button>

                            <p
                                class="text-center text-xs text-slate-400"
                            >
                                Setelah dibuat, kamu akan mendapatkan
                                kode pesanan untuk tracking.
                            </p>

                        </form>

                    </div>

                </section>



                

                <section
                    class="rounded-3xl bg-slate-900 text-white shadow-xl shadow-slate-900/20 overflow-hidden"
                >

                    <div class="p-7 md:p-9">

                        <div>

                            <p
                                class="text-xs font-black uppercase tracking-widest text-cyan-400"
                            >
                                Order Tracking
                            </p>

                            <h2
                                class="mt-2 text-2xl font-black"
                            >
                                Lacak Pesanan
                            </h2>

                            <p
                                class="mt-2 text-sm text-slate-400"
                            >
                                Masukkan kode pesanan untuk melihat
                                status laundry kamu.
                            </p>

                        </div>



                        

                        <form
                            action="<?php echo e(route('track')); ?>"
                            method="GET"
                            class="mt-8"
                        >

                            <div class="flex flex-col sm:flex-row gap-3">

                                <input
                                    type="text"
                                    name="order_code"
                                    value="<?php echo e(request('order_code')); ?>"
                                    placeholder="KL-A1B2C3D"
                                    class="flex-1 rounded-2xl bg-white/10 border border-white/10 px-5 py-4 text-white placeholder:text-slate-500 outline-none focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10 uppercase"
                                >

                                <button
                                    type="submit"
                                    class="rounded-2xl bg-white px-6 py-4 text-sm font-black text-slate-900 hover:bg-cyan-50 transition"
                                >
                                    Lacak
                                </button>

                            </div>

                        </form>



                        <?php if(request('order_code') && !$order): ?>

                            <div
                                class="mt-8 rounded-2xl border border-red-400/20 bg-red-400/10 p-5"
                            >

                                <div class="flex gap-3">

                                    <div class="text-red-400 font-bold">
                                        !
                                    </div>

                                    <div>

                                        <p class="font-bold text-red-300">
                                            Pesanan tidak ditemukan
                                        </p>

                                        <p class="mt-1 text-sm text-slate-400">
                                            Periksa kembali kode pesanan
                                            yang kamu masukkan.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        <?php endif; ?>



                        

                        <?php if($order): ?>

                            <div
                                id="trackingCard"
                                data-order-id="<?php echo e($order->id); ?>"
                                class="mt-8"
                            >

                                

                                <div
                                    class="rounded-2xl bg-white/5 border border-white/10 p-5"
                                >

                                    <div
                                        class="flex items-center justify-between gap-4"
                                    >

                                        <div>

                                            <p class="text-xs text-slate-500">
                                                Kode Pesanan
                                            </p>

                                            <p
                                                id="orderCode"
                                                class="mt-1 text-xl font-black tracking-wider"
                                            >
                                                <?php echo e($order->order_code); ?>

                                            </p>

                                        </div>

                                        <div
                                            id="statusBadge"
                                            class="rounded-full bg-cyan-400/10 px-4 py-2 text-xs font-black text-cyan-300"
                                        >
                                            <?php echo e($order->status_label); ?>

                                        </div>

                                    </div>

                                </div>



                                

                                <div
                                    class="grid grid-cols-2 gap-4 mt-4"
                                >

                                    <div
                                        class="rounded-2xl bg-white/5 border border-white/10 p-5"
                                    >

                                        <p class="text-xs text-slate-500">
                                            Pelanggan
                                        </p>

                                        <p
                                            id="customerName"
                                            class="mt-2 font-bold"
                                        >
                                            <?php echo e($order->customer_name); ?>

                                        </p>

                                    </div>


                                    <div
                                        class="rounded-2xl bg-white/5 border border-white/10 p-5"
                                    >

                                        <p class="text-xs text-slate-500">
                                            Berat
                                        </p>

                                        <p
                                            id="weightDisplay"
                                            class="mt-2 font-bold"
                                        >
                                            <?php echo e(number_format($order->weight, 2, ',', '.')); ?>

                                            Kg
                                        </p>

                                    </div>

                                </div>



                                

                                <div
                                    class="mt-4 rounded-2xl bg-white/5 border border-white/10 p-5"
                                >

                                    <div class="flex justify-between items-center">

                                        <div>

                                            <p class="text-xs text-slate-500">
                                                Total Harga
                                            </p>

                                            <p
                                                id="totalPrice"
                                                class="mt-1 text-2xl font-black"
                                            >
                                                Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?>

                                            </p>

                                        </div>

                                        <div class="text-cyan-400">

                                            <svg
                                                class="w-8 h-8"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 6v2m0 0v2m0-2c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                />

                                            </svg>

                                        </div>

                                    </div>

                                </div>



                                

                                <div class="mt-8">

                                    <div class="flex items-center justify-between mb-3">

                                        <span class="text-sm font-bold">
                                            Progress Laundry
                                        </span>

                                        <span
                                            id="progressText"
                                            class="text-sm font-black text-cyan-400"
                                        >
                                            <?php echo e($order->progress_percent); ?>%
                                        </span>

                                    </div>


                                    <div
                                        class="h-3 rounded-full bg-white/10 overflow-hidden"
                                    >

                                        <div
                                            id="progressBar"
                                            class="status-line h-full rounded-full bg-cyan-400"
                                            style="width: <?php echo e($order->progress_percent); ?>%"
                                        ></div>

                                    </div>

                                </div>



                                

                                <div
                                    class="grid grid-cols-5 gap-1 mt-6"
                                >

                                    <?php

                                        $statuses = [
                                            'received' => 'Received',
                                            'washing' => 'Washing',
                                            'drying' => 'Drying',
                                            'ironing' => 'Ironing',
                                            'ready' => 'Ready',
                                        ];

                                        $statusKeys = array_keys($statuses);

                                        $currentIndex = array_search(
                                            $order->status,
                                            $statusKeys,
                                            true
                                        );

                                    ?>


                                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php
                                            $stepIndex = array_search(
                                                $key,
                                                $statusKeys,
                                                true
                                            );

                                            $active = $currentIndex !== false &&
                                                $stepIndex <= $currentIndex;
                                        ?>

                                        <div class="text-center">

                                            <div
                                                class="mx-auto w-8 h-8 rounded-full flex items-center justify-center text-xs font-black
                                                <?php echo e($active
                                                    ? 'bg-cyan-400 text-slate-900'
                                                    : 'bg-white/10 text-slate-500'); ?>"
                                            >
                                                <?php echo e($stepIndex + 1); ?>

                                            </div>

                                            <p
                                                class="mt-2 text-[10px] sm:text-xs <?php echo e($active ? 'text-cyan-300' : 'text-slate-500'); ?>"
                                            >
                                                <?php echo e($label); ?>

                                            </p>

                                        </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>



                                

                                <div
                                    class="mt-8 rounded-2xl bg-cyan-400/10 border border-cyan-400/10 p-5"
                                >

                                    <p class="text-xs text-slate-500">
                                        Estimasi selesai
                                    </p>

                                    <p
                                        id="estimatedReady"
                                        class="mt-1 font-black text-cyan-300"
                                    >

                                        <?php if($order->estimated_ready_at): ?>

                                            <?php echo e($order->estimated_ready_at->format('d M Y, H:i')); ?>


                                        <?php else: ?>

                                            Belum ditentukan

                                        <?php endif; ?>

                                    </p>

                                </div>


                            </div>

                        <?php else: ?>

                            

                            <div
                                class="mt-10 py-12 text-center border border-dashed border-white/10 rounded-2xl"
                            >

                                <div
                                    class="mx-auto w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center text-cyan-400"
                                >

                                    <svg
                                        class="w-8 h-8"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 20l-5.447-2.724A2 2 0 012.447 15.5V8.5a2 2 0 011.106-1.789L9 4m0 16V4m0 16l6 3m-6-19l6 3m0 16l5.447-2.724A2 2 0 0021.553 15.5V8.5a2 2 0 00-1.106-1.789L15 4m0 16V4"
                                        />

                                    </svg>

                                </div>

                                <p
                                    class="mt-5 font-bold text-slate-300"
                                >
                                    Belum ada pesanan yang dilacak
                                </p>

                                <p
                                    class="mt-2 text-sm text-slate-500"
                                >
                                    Masukkan kode pesanan kamu di atas.
                                </p>

                            </div>

                        <?php endif; ?>

                    </div>

                </section>

            </div>



            

            <div
                class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4"
            >

                <div class="rounded-2xl bg-white border border-slate-200 p-5">

                    <div class="text-cyan-500 font-black">
                        01
                    </div>

                    <h3 class="mt-3 font-black">
                        Buat Pesanan
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Isi nama, WhatsApp dan berat laundry.
                    </p>

                </div>


                <div class="rounded-2xl bg-white border border-slate-200 p-5">

                    <div class="text-cyan-500 font-black">
                        02
                    </div>

                    <h3 class="mt-3 font-black">
                        Dapatkan Kode
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Simpan kode pesanan yang diberikan sistem.
                    </p>

                </div>


                <div class="rounded-2xl bg-white border border-slate-200 p-5">

                    <div class="text-cyan-500 font-black">
                        03
                    </div>

                    <h3 class="mt-3 font-black">
                        Pantau Laundry
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Lihat progress tanpa perlu login.
                    </p>

                </div>

            </div>

        </div>

    </main>



    

    <script>

        const laundryRate = <?php echo e((int) config('laundry.rate')); ?>;

        const weightInput =
            document.getElementById('weight');

        const pricePreview =
            document.getElementById('pricePreview');


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


        function updatePrice() {

            if (!weightInput || !pricePreview) {
                return;
            }

            const weight =
                parseFloat(weightInput.value) || 0;

            const total =
                Math.ceil(weight * laundryRate);

            pricePreview.textContent =
                formatRupiah(total);

        }


        if (weightInput) {

            weightInput.addEventListener(
                'input',
                updatePrice
            );

            updatePrice();

        }



        // =========================================================
        // REALTIME TRACKING
        // =========================================================

        const trackingCard =
            document.getElementById('trackingCard');


        if (trackingCard) {

            const orderId =
                trackingCard.dataset.orderId;


            function updateTracking() {

                fetch(
                    `/track/${orderId}`,
                    {
                        headers: {
                            'Accept': 'application/json'
                        }
                    }
                )

                .then(response => {

                    if (!response.ok) {
                        throw new Error(
                            'Gagal mengambil data pesanan'
                        );
                    }

                    return response.json();

                })

                .then(data => {

                    // Customer
                    const customerName =
                        document.getElementById('customerName');

                    if (customerName) {
                        customerName.textContent =
                            data.customer_name;
                    }


                    // Weight
                    const weightDisplay =
                        document.getElementById('weightDisplay');

                    if (weightDisplay) {

                        weightDisplay.textContent =
                            Number(data.weight)
                                .toLocaleString('id-ID', {
                                    minimumFractionDigits: 2
                                }) + ' Kg';

                    }


                    // Price
                    const totalPrice =
                        document.getElementById('totalPrice');

                    if (totalPrice) {

                        totalPrice.textContent =
                            formatRupiah(
                                Number(data.total_price)
                            );

                    }


                    // Status
                    const statusBadge =
                        document.getElementById('statusBadge');

                    if (statusBadge) {
                        statusBadge.textContent =
                            data.status_label;
                    }


                    // Progress
                    const progressBar =
                        document.getElementById('progressBar');

                    const progressText =
                        document.getElementById('progressText');

                    if (progressBar) {

                        progressBar.style.width =
                            data.progress_percent + '%';

                    }

                    if (progressText) {

                        progressText.textContent =
                            data.progress_percent + '%';

                    }


                    // Estimated ready
                    const estimatedReady =
                        document.getElementById('estimatedReady');

                    if (estimatedReady) {

                        if (data.estimated_ready_at) {

                            const date =
                                new Date(
                                    data.estimated_ready_at
                                );

                            estimatedReady.textContent =
                                date.toLocaleString(
                                    'id-ID',
                                    {
                                        day: '2-digit',
                                        month: 'short',
                                        year: 'numeric',
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    }
                                );

                        } else {

                            estimatedReady.textContent =
                                'Belum ditentukan';

                        }

                    }

                })

                .catch(error => {

                    console.error(
                        'Tracking error:',
                        error
                    );

                });

            }


            // Update setiap 3 detik
            updateTracking();

            setInterval(
                updateTracking,
                3000
            );

        }

    </script>

</body>

</html><?php /**PATH D:\My_Project\WEBSITE LAUNDRY\resources\views/users/order.blade.php ENDPATH**/ ?>