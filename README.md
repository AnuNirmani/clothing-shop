# 👕 Clothing Shop (Aura Edit)

A full-stack e-commerce and inventory management system built with Laravel and React, designed to provide a modern storefront experience alongside a robust administrative backend.

## 🚀 Overview

Aura Edit clothing shop is a scalable web application that combines a React-powered storefront with a Laravel-based admin panel. The system supports complete inventory control, product management, offer handling, and image galleries, while exposing structured JSON APIs for frontend consumption.

The application is structured to separate customer-facing functionality from administrative operations, ensuring maintainability and extensibility.


## 📂 Project Structure

- `app/Http/Controllers` - Admin and API controllers
- `app/Models` - Domain models (`Item`, `Type`, `Category`, `Color`, etc.)
- `routes/web.php` - Web routes (storefront entry + admin resources)
- `routes/api.php` - Storefront APIs
- `resources/js` - React storefront app
- `resources/views` - Blade views for admin/auth and React mount page

## 🏗️ Core Features

### 🛍️ Storefront (React)

- Homepage with latest items and category/type highlights
- Shop listing with category/type filtering via query params
- Item detail page with:
  - image gallery
  - color display
  - offer pricing and installment calculation display
  - size chart modal
  - cart add/update logic with stock limit checks
- Cart state persisted in browser `localStorage`

### 🔐 Admin Panel (Laravel + Blade)

Authenticated CRUD for:
- Items
- Types
- Categories
- Classifications
- Colors
- Materials
- Sizes
- Users

Inventory-specific behavior:
- stock quantity tracking (`stock_items`)
- availability
- offer fields (`is_on_offer`, `offer_percentage`, `dates`, `discounted_price`)
- gift card fields (`is_gift_card`, `gift_card_validity_months`)
- multiple item photos (`item_photos`)
- soft delete support for items

## ⚙️ Setup Instructions

### 1️⃣ Install dependencies

```bash
composer install
npm install
```

### 2️⃣ Environment configuration

Create `.env` (if not present) and configure:

- `APP_URL`
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

Generate app key:

```bash
php artisan key:generate
```

### 3️⃣ Database setup

```bash
php artisan migrate
```

Optional: run seeders (if needed for initial lookup tables):

```bash
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=TypeSeeder
php artisan db:seed --class=ColorSeeder
php artisan db:seed --class=ClassificationSeeder
php artisan db:seed --class=MaterialSeeder
php artisan db:seed --class=SizeSeeder
```

### 4️⃣ Storage link for uploaded images

```bash
php artisan storage:link
```

### 5️⃣ Run development servers

Terminal 1:

```bash
php artisan serve
```

Terminal 2:

```bash
npm run dev
```

Open: `http://127.0.0.1:8000`

## 🧪 Useful Commands

```bash
npm run dev        # Start Vite dev server
npm run build      # Production frontend build
php artisan test   # Run test suite
php artisan route:list
```

## 🔒 Authentication and Access

- Admin routes are protected by `auth` middleware.
- Default Laravel auth routes are loaded from `routes/auth.php`.
- Dashboard entry: `/dashboard`


## 📄 License

This project is licensed under the MIT License. See the [LICENSE](./LICENSE) file for details.
