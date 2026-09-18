<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login Admin - Kang Laundry</title>

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
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-950">

    <div class="min-h-screen flex">

        
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">

            
            <div class="absolute inset-0 bg-gradient-to-br from-blue-700 via-blue-800 to-slate-950"></div>

            
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-blue-400/20 rounded-full"></div>

            <div class="absolute -bottom-40 -right-20 w-[500px] h-[500px] bg-cyan-400/10 rounded-full"></div>

            
            <div class="relative z-10 flex flex-col justify-center px-16 xl:px-24 text-white">

                <div class="mb-8">

                    <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur flex items-center justify-center mb-6 border border-white/20">

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
                                d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7M8 11h8M9 15h6"
                            />
                        </svg>

                    </div>

                    <h1 class="text-5xl font-extrabold tracking-tight">
                        Kang Laundry
                    </h1>

                    <p class="mt-4 text-xl text-blue-100">
                        Sistem Manajemen Laundry
                    </p>

                </div>

                <p class="max-w-lg text-blue-100 leading-relaxed">
                    Kelola pesanan laundry, pantau proses pengerjaan,
                    perbarui status pesanan, dan kelola pelanggan
                    melalui dashboard administrator.
                </p>

                
                <div class="mt-10 space-y-5">

                    <div class="flex items-center gap-4">

                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                            ✓
                        </div>

                        <span class="text-blue-50">
                            Kelola seluruh pesanan
                        </span>

                    </div>

                    <div class="flex items-center gap-4">

                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                            ✓
                        </div>

                        <span class="text-blue-50">
                            Update status laundry
                        </span>

                    </div>

                    <div class="flex items-center gap-4">

                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                            ✓
                        </div>

                        <span class="text-blue-50">
                            Pantau pesanan pelanggan
                        </span>

                    </div>

                </div>

            </div>

        </div>


        
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12 bg-white">

            <div class="w-full max-w-md">

                
                <div class="lg:hidden text-center mb-10">

                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-600 text-white mb-4">

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
                                d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7M8 11h8M9 15h6"
                            />
                        </svg>

                    </div>

                    <h1 class="text-3xl font-extrabold text-slate-900">
                        Kang Laundry
                    </h1>

                    <p class="text-slate-500 mt-2">
                        Admin Dashboard
                    </p>

                </div>


                
                <div class="mb-8">

                    <p class="text-sm font-semibold text-blue-600 uppercase tracking-wider">
                        Administrator
                    </p>

                    <h2 class="text-3xl font-bold text-slate-900 mt-2">
                        Selamat Datang
                    </h2>

                    <p class="text-slate-500 mt-2">
                        Silakan login untuk mengakses dashboard admin.
                    </p>

                </div>


                
                <?php if(session('success')): ?>

                    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4">

                        <div class="flex gap-3">

                            <div class="text-green-600">
                                ✓
                            </div>

                            <p class="text-sm text-green-700">
                                <?php echo e(session('success')); ?>

                            </p>

                        </div>

                    </div>

                <?php endif; ?>


                
                <?php if($errors->any()): ?>

                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

                        <div class="flex gap-3">

                            <div class="text-red-600">
                                !
                            </div>

                            <div>

                                <p class="font-semibold text-red-800 text-sm">
                                    Login gagal
                                </p>

                                <ul class="mt-1 text-sm text-red-700 space-y-1">

                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <li>
                                            <?php echo e($error); ?>

                                        </li>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </ul>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>


                
                <form
                    method="POST"
                    action="<?php echo e(route('admin.login.submit')); ?>"
                    class="space-y-6"
                >

                    <?php echo csrf_field(); ?>


                    
                    <div>

                        <label
                            for="email"
                            class="block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Email Admin
                        </label>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                                <svg
                                    class="w-5 h-5 text-slate-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    />
                                </svg>

                            </div>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="<?php echo e(old('email')); ?>"
                                required
                                autofocus
                                autocomplete="email"
                                placeholder="admin@kanglaundry.com"
                                class="w-full rounded-xl border border-slate-300 bg-white py-3.5 pl-12 pr-4 text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                            >

                        </div>

                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                            <p class="mt-2 text-sm text-red-600">
                                <?php echo e($message); ?>

                            </p>

                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>


                    
                    <div>

                        <div class="flex items-center justify-between mb-2">

                            <label
                                for="password"
                                class="block text-sm font-semibold text-slate-700"
                            >
                                Password
                            </label>

                        </div>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                                <svg
                                    class="w-5 h-5 text-slate-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-5a2 2 0 00-2-2H6a2 2 0 00-2 2v5a2 2 0 002 2zm10-9V7a4 4 0 00-8 0v3h8z"
                                    />
                                </svg>

                            </div>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                                class="w-full rounded-xl border border-slate-300 bg-white py-3.5 pl-12 pr-12 text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                            >

                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600"
                            >

                                <svg
                                    id="eyeIcon"
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />

                                </svg>

                            </button>

                        </div>

                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                            <p class="mt-2 text-sm text-red-600">
                                <?php echo e($message); ?>

                            </p>

                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>


                    
                    <div class="flex items-center">

                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            value="1"
                            class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                        >

                        <label
                            for="remember"
                            class="ml-3 text-sm text-slate-600"
                        >
                            Ingat saya
                        </label>

                    </div>


                    
                    <button
                        type="submit"
                        class="w-full rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 active:scale-[0.99]"
                    >
                        Masuk ke Dashboard
                    </button>

                </form>


                
                <div class="mt-8 text-center">

                    <a
                        href="<?php echo e(route('user.order')); ?>"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-blue-600 transition"
                    >

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"
                            />
                        </svg>

                        Kembali ke halaman pelanggan

                    </a>

                </div>


                
                <div class="mt-10 pt-6 border-t border-slate-200 text-center">

                    <p class="text-xs text-slate-400">
                        © <?php echo e(date('Y')); ?> Kang Laundry.
                        Admin Area.
                    </p>

                </div>

            </div>

        </div>

    </div>


    
    <script>

        function togglePassword() {

            const password =
                document.getElementById('password');

            const eyeIcon =
                document.getElementById('eyeIcon');

            if (password.type === 'password') {

                password.type = 'text';

                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.04-3.368M6.228 6.228A9.958 9.958 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.132 5.168M6.228 6.228L3 3m3.228 3.228l3.164 3.164m0 0a3 3 0 104.243 4.243m-4.243-4.243L21 21"
                    />
                `;

            } else {

                password.type = 'password';

                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542-7-1.274-4.057-5.065-7-9.542-7-4.477 0-8.268 2.943-9.542 7z"
                    />
                `;

            }

        }

    </script>

</body>
</html><?php /**PATH D:\My_Project\WEBSITE LAUNDRY\resources\views/admin/login.blade.php ENDPATH**/ ?>