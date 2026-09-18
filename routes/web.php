<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return <<<'HTML'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard - Kang Laundry</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-slate-50 font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white p-4 flex justify-between items-center shadow-md">
        <div class="flex items-center space-x-2">
            <i class="fa-solid fa-soap text-2xl text-cyan-400"></i>
            <span class="font-bold text-lg tracking-wider">
                KANG LAUNDRY ADMIN
            </span>
        </div>

        <span class="bg-cyan-500 text-xs px-3 py-1 rounded-full font-semibold">
            CEO Mode
        </span>
    </nav>

    <div class="max-w-7xl mx-auto p-4 md:p-6">

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

            <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100
                        flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500 font-medium">
                        Cucian Diproses
                    </p>

                    <h3 class="text-2xl font-bold text-slate-800">
                        12 Order
                    </h3>
                </div>

                <div class="bg-amber-100 text-amber-600 p-3 rounded-lg">
                    <i class="fa-solid fa-spinner fa-spin text-xl"></i>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100
                        flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500 font-medium">
                        Siap Diambil
                    </p>

                    <h3 class="text-2xl font-bold text-emerald-600">
                        5 Order
                    </h3>
                </div>

                <div class="bg-emerald-100 text-emerald-600 p-3 rounded-lg">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100
                        flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500 font-medium">
                        Total Pendapatan
                    </p>

                    <h3 class="text-2xl font-bold text-blue-900">
                        Rp 450.000
                    </h3>
                </div>

                <div class="bg-blue-100 text-blue-900 p-3 rounded-lg">
                    <i class="fa-solid fa-wallet text-xl"></i>
                </div>
            </div>

        </div>

        <!-- Konten -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Form Order -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 h-fit">

                <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-plus-circle text-cyan-500"></i>
                    Input Order Baru
                </h2>

                <form class="space-y-4">

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">
                            Nama Pelanggan
                        </label>

                        <input
                            type="text"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg
                                   focus:outline-none focus:border-cyan-500"
                            placeholder="Budi">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">
                            No. WhatsApp
                        </label>

                        <input
                            type="text"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg
                                   focus:outline-none focus:border-cyan-500"
                            placeholder="628123xxx">
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1">
                                Berat (KG)
                            </label>

                            <input
                                type="number"
                                id="weightInput"
                                class="w-full px-3 py-2 border border-slate-200 rounded-lg
                                       focus:outline-none focus:border-cyan-500"
                                placeholder="0">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1">
                                Total Bayar
                            </label>

                            <input
                                type="text"
                                id="totalOutput"
                                class="w-full px-3 py-2 bg-slate-100 border
                                       border-slate-200 rounded-lg font-bold text-blue-900"
                                value="Rp 0"
                                readonly>
                        </div>

                    </div>

                    <button
                        type="button"
                        onclick="sendWhatsApp()"
                        class="w-full bg-emerald-500 hover:bg-emerald-600
                               text-white font-semibold py-2 rounded-lg
                               transition duration-200 flex justify-center
                               items-center gap-2">

                        <i class="fa-brands fa-whatsapp"></i>
                        Kirim Order via WA

                    </button>

                </form>
            </div>

            <!-- Daftar Cucian -->
            <div class="lg:col-span-2 bg-white p-5 rounded-xl shadow-sm border border-slate-100">

                <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-list-check text-cyan-500"></i>
                    Daftar Cucian Aktif & Waktu Tunggu
                </h2>

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead>
                            <tr class="bg-slate-50 text-slate-600 text-sm border-b border-slate-100">
                                <th class="p-3">Pelanggan</th>
                                <th class="p-3">Detail</th>
                                <th class="p-3">Status/Estimasi</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="text-sm divide-y divide-slate-100">

                            <tr>

                                <td class="p-3">
                                    <span class="font-bold text-cyan-600">
                                        #ORD-01
                                    </span>

                                    <div class="font-medium">
                                        Andi
                                    </div>
                                </td>

                                <td class="p-3">
                                    4 Kg

                                    <div class="font-bold text-blue-900">
                                        Rp 40.000
                                    </div>
                                </td>

                                <td class="p-3">

                                    <span class="bg-amber-100 text-amber-700
                                                 text-xs px-2 py-0.5 rounded
                                                 font-semibold uppercase">
                                        Dicuci
                                    </span>

                                    <div class="text-xs text-slate-400 mt-1">
                                        Waktu Tunggu: 2 Jam Lagi
                                    </div>

                                </td>

                                <td class="p-3 flex justify-center gap-2">

                                    <button
                                        onclick="window.print()"
                                        class="bg-blue-600 text-white p-2 rounded"
                                        title="Cetak Nota">

                                        <i class="fa-solid fa-print"></i>

                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>
            </div>

        </div>

    </div>

    <script>

        const weightInput = document.getElementById('weightInput');
        const totalOutput = document.getElementById('totalOutput');

        weightInput.addEventListener('input', function () {

            const weight = parseFloat(this.value) || 0;

            const total = weight * 10000;

            totalOutput.value =
                'Rp ' + total.toLocaleString('id-ID');

        });

        function sendWhatsApp() {

            const weight = weightInput.value;
            const total = totalOutput.value;

            const message =
                `Halo Kang Laundry,%0A%0A` +
                `Saya ingin membuat order laundry.%0A` +
                `Berat: ${weight} Kg%0A` +
                `Total: ${total}`;

            const phone = '6281234567890';

            window.open(
                `https://wa.me/${phone}?text=${message}`,
                '_blank'
            );
        }

    </script>

</body>
</html>
HTML;
});