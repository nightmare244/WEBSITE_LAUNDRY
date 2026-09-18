<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? 'Kang Laundry'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: {
            fontFamily: { sans: ['ui-sans-serif', 'system-ui', 'sans-serif'] },
            colors: { ink: '#10243e', aqua: '#06b6d4' }
        } } };
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .water-grid { background-image: linear-gradient(rgba(6,182,212,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(6,182,212,.08) 1px, transparent 1px); background-size: 32px 32px; }
        @media print { .no-print { display: none !important; } }
    </style>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
    <?php echo $__env->yieldContent('body'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\My_Project\WEBSITE LAUNDRY\resources\views/layouts/app.blade.php ENDPATH**/ ?>