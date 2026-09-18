# Kang Laundry

A Laravel 12 + Tailwind CSS order management app for a local laundry business.

## Setup

1. Install PHP 8.2+, Composer, and SQLite.
2. Run `composer install`.
3. Copy `.env.example` to `.env`.
4. Create an empty `database/database.sqlite` file.
5. Run `php artisan key:generate` and `php artisan migrate`.
6. Start the app with `php artisan serve`.

Open `/track` for the customer tracking page and `/admin` for the operations dashboard.

## Included flows

- Server-authoritative order pricing at Rp 10.000/kg.
- Live calculator with WhatsApp order handoff.
- Searchable and filterable admin order table.
- One-click status updates and customer WhatsApp notifications.
- Soft-delete archive for old orders.
- Public tracking timeline: Received, Washing, Drying, Ironing, Ready to Pick Up.
- 80mm thermal receipt layout with browser print dialog.

The default WhatsApp destination is `+6287833648640` and can be changed with `WHATSAPP_NUMBER` in `.env`.
