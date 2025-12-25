# Laravel eCommerce Platform

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

A full-featured eCommerce platform built with Laravel 12.x, offering a complete online shopping solution with advanced inventory management, multi-theme support, and comprehensive analytics.

## Class Diagram

![Class Diagram](assets/ClassDiagram.png)

## Features

### Product Management
- **Unlimited Products**: Sell any number of products with up to 2 high-quality images each
- **Automatic Stock Management**: Real-time inventory updates after every sale
- **Dynamic CRUD System**: Manage products, categories, and promotions directly from the admin panel

### Design & Customization
- **Dynamic Multi-Themes**: 5+ prebuilt color themes
- **Fully Customizable**: Real-time theme changes without code modifications
- **Responsive Design**: Optimized for desktop, tablet, and mobile devices

### Shopping Experience
- **Full Checkout System**: Secure, dynamic cart with automatic calculations
- **Smart Calculations**: Automatic subtotal, shipping, and total computations

### Admin & Analytics
- **Revenue & Growth Analytics**: Track sales, net revenue, and growth percentages over any period
- **Order Management**: Edit, update, and track orders with full support for updates
- **Multi-Role System**: Scalable MySQL database with admin, client, and custom user roles

### Architecture
- **Professional & Scalable**: Full-stack Laravel MVC solution
- **Secure & Extensible**: Enterprise-grade security, unlike serverless or limited platforms

## System Requirements

- **Operating System**: Windows 10/11, macOS, or Linux
- **PHP**: 8.0 or greater
- **Laravel**: 12.x
- **Database**: MySQL 5.7+ or MariaDB 10+
- **Composer**: Latest version
- **Node.js & npm**: LTS version recommended
- **Web Server**: Apache (via XAMPP) or Nginx

## Installation Guide

### Step 1: Install Composer

1. Download from [https://getcomposer.org/download](https://getcomposer.org/download)
2. Install globally on your system
3. Verify installation:
   ```bash
   composer -v
   ```

### Step 2: Install XAMPP

1. Download from [https://www.apachefriends.org](https://www.apachefriends.org)
2. Install with Apache and MySQL included
3. Start XAMPP Control Panel
4. Ensure Apache and MySQL are running

### Step 3: Install PHP (if not included with XAMPP)

1. Download from [https://www.php.net/downloads](https://www.php.net/downloads)
2. Choose **Thread Safe** version
3. Extract to a folder (e.g., `C:\php`)

### Step 4: Add PHP to Environment Variables

1. Copy your PHP folder path (e.g., `C:\php`)
2. Navigate to: `Control Panel → System → Advanced System Settings → Environment Variables`
3. Under "System Variables", select `Path` → Click `Edit` → Click `New`
4. Paste the PHP path and save
5. Verify installation:
   ```bash
   php -v
   ```

### Step 5: Install Node.js

1. Download LTS version from [https://nodejs.org/en/download](https://nodejs.org/en/download)
2. Install (npm is included)
3. Verify installation:
   ```bash
   node -v
   npm -v
   ```

### Step 6: Prepare the Project

1. Unzip the project folder to your desired location (e.g., `C:\laravel-ecommerce`)
2. Open terminal/command prompt inside the project folder
3. Install dependencies:
   ```bash
   composer install
   php artisan key:generate
   npm install
   ```

### Step 7: Configure Database

1. Copy `.env.example` to `.env`:
   ```bash
   cp .env.example .env
   ```
2. Open `.env` and update database settings:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Create the database in phpMyAdmin matching the `DB_DATABASE` name

### Step 8: Run Database Migrations

```bash
php artisan migrate
```

### Step 9: Link Storage

```bash
php artisan storage:link
```

### Step 10: Run Laravel Development Server

```bash
php artisan serve
```

Open your browser and navigate to: [http://127.0.0.1:8000](http://127.0.0.1:8000)

🎉 Your eCommerce website is now live!

### Step 11: Create Admin Account

1. Register as a normal user through the website
2. Open phpMyAdmin
3. Navigate to your database → `users` table
4. Find your user record and change the `role` column to `admin`

## Tips for Beginners

- Always run terminal as **Administrator** if you face permission issues
- Ensure firewall/antivirus allows Apache and MySQL
- Verify all installations before proceeding:
  ```bash
  php -v
  composer -v
  npm -v
  node -v
  ```
- If you encounter errors, check the Laravel log file at `storage/logs/laravel.log`

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing)
- [Powerful dependency injection container](https://laravel.com/docs/container)
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent)
- Database agnostic [schema migrations](https://laravel.com/docs/migrations)
- [Robust background job processing](https://laravel.com/docs/queues)
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting)

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript.

## Contributing

Thank you for considering contributing to this project! Please feel free to submit pull requests or open issues for bugs and feature requests.

## Security Vulnerabilities

If you discover a security vulnerability within this application, please create an issue or contact the maintainers directly. All security vulnerabilities will be promptly addressed.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support, please open an issue in the GitHub repository or refer to the [Laravel documentation](https://laravel.com/docs) for framework-specific questions.

---

Built with ❤️ using Laravel
