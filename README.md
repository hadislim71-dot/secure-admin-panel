# Task 19 – Secure Admin Panel

A beginner-friendly PHP + MySQL admin panel for XAMPP. It uses plain PHP pages, PDO prepared statements, sessions, admin role checks, CSRF form tokens, server-side validation, and Bootstrap.

## Step 1: Start XAMPP and create the database

1. Start **Apache** and **MySQL** in the XAMPP Control Panel.
2. Open phpMyAdmin at `http://localhost/phpmyadmin`.
3. Import `task19.sql`. It creates `task19_admin` and the users, products, and orders tables.

## Step 2: Copy into XAMPP

Copy the `Task19` folder to `C:\xampp\htdocs\Task19` (use your XAMPP `htdocs` folder if installed elsewhere). Check `config/db.php`; default XAMPP MySQL uses username `root` and an empty password.

## Step 3: Create your first administrator

Visit `http://localhost/Task19/setup_admin.php` and enter your own name, email, and password. The password is saved with `password_hash()`. Once an administrator exists, the setup form closes. For a public server, delete `setup_admin.php` after setting up the initial account.

## Step 4: Sign in and use the panel

Open `http://localhost/Task19/login.php`. From the dashboard you can add, edit, and delete products, create orders and change order status, and add, edit, or delete users. Staff accounts cannot sign in to this administrator panel. Log out with the button in the top navigation.

## What each part does

- `task19.sql`: creates the database and tables.
- `config/db.php`: connects PHP to MySQL through PDO.
- `includes/auth.php`: starts the session and provides the admin-only check.
- `setup_admin.php`, `login.php`, `logout.php`: create the first account, authenticate, and end the session.
- `dashboard.php`, `products.php`, `orders.php`, `users.php`: protected management pages.
- `functions.php`: HTML escaping, CSRF tokens, and one-time messages.
- `assets/style.css`: small style additions; Bootstrap provides the main layout.

## Security ideas used

- Login uses a prepared `SELECT` and `password_verify()`.
- User creation uses `password_hash()`; raw passwords are never saved.
- Each management page calls `require_admin()` before displaying data or processing forms.
- Form values in SQL are passed through PDO placeholders and bound values.
- Changes require POST and a CSRF token. Displayed values are escaped with `htmlspecialchars()`.
- Inputs are checked on the server; browser checks are only a convenience.

This is a learning project for local XAMPP use, not a complete production store. Each order records one product and quantity; inventory is not automatically decremented.
