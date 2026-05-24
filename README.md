# 🥐 Bakery Management System

A simple and efficient bakery management web application built with **Laravel** (PHP) and **SQLite**. It helps bakery owners manage products, orders, and inventory in a clean digital way.

---

## 📋 Features

- **Products** — Add, edit, and delete bakery items with price and stock levels
- **Orders** — Create and manage customer orders with automatic stock updates
- **Inventory** — Log restocks, adjustments, and sales
- **Dashboard** — Overview of total products, orders, revenue, low stock alerts, and recent orders

---

## 🛠 Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 11 (PHP) |
| Frontend | Blade Templates + Tailwind CSS |
| Database | SQLite |
| Build Tool | Vite |

---

## ⚙️ Requirements

Make sure you have the following installed on your Mac:

- PHP 8.2+
- Composer
- Node.js & npm

---

## 🚀 Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/YOUR_USERNAME/bakery-system.git
cd bakery-system
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Set Up Environment File

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Set Up the Database

Open the `.env` file and make sure the database section looks like this:

```env
DB_CONNECTION=sqlite
```

Comment out or delete these lines:
```env
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

Then create the SQLite file:

```bash
touch database/database.sqlite
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Start the Servers

Open **two terminal tabs**:

**Tab 1 — Laravel backend:**
```bash
php artisan serve
```

**Tab 2 — Vite frontend:**
```bash
npm run dev
```

### 8. Open the App

Visit **http://localhost:8000** in your browser.

---

## 📖 How to Use

### Products
- Go to **Products** in the navbar
- Click **+ Add Product** to add a new bakery item
- Fill in the name, category, price, and stock
- Use **Edit** to update or **Delete** to remove a product

### Orders
- Go to **Orders** in the navbar
- Click **+ New Order** to create a customer order
- Select a product, enter quantity and set the status
- Stock is automatically updated based on order status:
  - **Pending / Completed** → stock is deducted
  - **Cancelled** → stock is restored
  - **Deleted** → stock is restored (if not cancelled)

### Inventory
- Go to **Inventory** in the navbar
- Click **+ Add Record** to log a stock movement
- Choose the type:
  - **Restock** → adds to product stock (new items arrived)
  - **Adjustment** → removes from product stock (waste, damage, expiry)
  - **Sale** → record only, no stock change (manual offline note)

### Dashboard
- The home page shows a full overview:
  - Total products, orders, and revenue
  - Order breakdown by status (pending, completed, cancelled)
  - Low stock alerts (products with 5 or fewer items)
  - 5 most recent orders

---
## 📁 Project Structure

```
bakery-system/
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php
│   │   ├── ProductController.php
│   │   ├── OrderController.php
│   │   └── InventoryController.php
│   └── Models/
│       ├── Product.php
│       ├── Order.php
│       └── Inventory.php
├── database/
│   ├── migrations/
│   └── database.sqlite
├── resources/
│   └── views/
│       ├── layouts/app.blade.php
│       ├── dashboard.blade.php
│       ├── products/
│       ├── orders/
│       └── inventories/
└── routes/
    └── web.php
```
---

## 🔮 Planned Features (v2)

- 🔐 Staff login and authentication
- 📊 Sales and stock charts
- 🖨️ Export orders as PDF
- 🔔 Low stock email alerts

---

## 👤 Author

Built by **Sofonyas** — [Pixel Creatives](https://github.com/sofonyast)