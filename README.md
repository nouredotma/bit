# Wer Store

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel)
![Vue.js](https://img.shields.io/badge/Vue.js-3.5-4FC08D?style=for-the-badge&logo=vue.js)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.0-38B2AC?style=for-the-badge&logo=tailwind-css)
![Vite](https://img.shields.io/badge/Vite-7.0-646CFF?style=for-the-badge&logo=vite)

**Wer Store** is a modern, high-performance e-commerce platform designed for speed, scalability, and an exceptional user experience. Built on the latest **Laravel 12** framework and powered by **Vue 3** and **Tailwind CSS 4**, Wer offers a premium shopping experience with a robust administrative backend.

---

## ✨ Key Features

### 🛒 E-Commerce Storefront
- **Dynamic Product Catalog**: High-performance listing and filtering of products.
- **Deep Product Details**: Rich product views with integrated media and specifications.
- **Persistent Shopping Cart**: Seamless `localStorage` integration ensuring user carts persist across sessions.
- **Fluid Checkout**: Streamlined checkout process optimized for conversion.

### 🛠️ Administrative Excellence
- **Comprehensive Dashboard**: Real-time overview of store performance and metrics.
- **Product & Category Management**: Full CRUD capabilities for inventory control.
- **Order Tracking**: Detailed order management system for efficient fulfillment.
- **Secure Access**: Robust admin authentication and authorization.

### 🎨 Design & Experience
- **Tailwind CSS 4**: Utilizing the latest in CSS utilities for a cutting-edge aesthetic.
- **Responsive Architecture**: Built with `svh` units for pixel-perfect layouts on every device.
- **Premium Aesthetics**: Curated color palettes, smooth transitions, and modern typography.

---

## 🚀 Tech Stack

- **Backend**: [Laravel 12](https://laravel.com) (PHP 8.2+)
- **Frontend**: [Vue 3](https://vuejs.org), [Vite](https://vitejs.dev), [Tailwind CSS 4](https://tailwindcss.com)
- **Database**: Eloquent ORM (supports MySQL, PostgreSQL, SQLite)
- **Tooling**: Composer, NPM, Artisan

---

## 📦 Installation & Setup

Getting started with **Wer Store** is straightforward. Follow these steps to set up your local development environment:

### 1. Prerequisites
Ensure you have the following installed:
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- A local database (MySQL/PostgreSQL/SQLite)

### 2. Clone the Repository
```bash
git clone https://github.com/nouredotma/wer.git
cd wer
```

### 3. Automated Setup
We've included a comprehensive setup script in `composer.json` to handle dependencies, environment configuration, and database migrations:
```bash
composer setup
```
*This command will install Composer/NPM dependencies, generate the application key, and run migrations.*

### 4. Run the Development Server
Start the Vite dev server and the Laravel application concurrently:
```bash
npm run dev
```

The application will be available at `http://localhost:8000`.

---

## 🧪 Seeding Data
To populate the store with high-quality mock data (products, categories, and orders), run the database seeder:
```bash
php artisan db:seed
```


<p align="center">
  Built with ❤️ by the Wer Team
</p>

