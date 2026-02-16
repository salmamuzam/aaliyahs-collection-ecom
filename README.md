# Aaliyah's Collection – Premium SaaS E-Commerce Engine

**Aaliyah's Collection** is a modern, scalable SaaS e-commerce platform built using the **Laravel 12 Framework**. This system serves as a robust backend engine, providing a high-performance RESTful API for mobile/frontend integration while offering a sophisticated web-based management console for admins and customers.

---

## 📖 Table of Contents
- [Core Architecture](#-core-architecture)
- [Key Features](#-key-features)
- [Database Mastery (SQL)](#-database-mastery-sql)
- [Security Implementation](#-security-implementation)
- [API Documentation (v1)](#-api-documentation-v1)
- [Tech Stack](#-tech-stack)
- [Installation & Setup](#-installation--setup)
- [Folder Structure](#-folder-structure)

---

## 🏗️ Core Architecture
The application is built on the **MVC (Model-View-Controller)** pattern, enhanced by modern Laravel ecosystem tools:

- **Frontend Logic:** Powered by **Livewire 3** and **Tailwind CSS** for a reactive, "SaaS-feel" user experience without full-page reloads.  
- **Authentication:** Fully integrated with **Laravel Jetstream (Fortify/Sanctum)** for secure multi-layered access control.  
- **Service Layer:** Custom Helpers and Http Resources ensure a clean separation between database logic and API responses.  

---

## ✨ Key Features

### 🔐 Multi-Layer Authentication
- **Jetstream Integration:** Secure web-based login, registration, and profile management.  
- **Two-Factor Authentication (2FA):** Native support for TOTP-based security.  
- **Sanctum API Mastery:** Token-based authentication for external devices with granular abilities (`admin:access` vs `customer:access`).  
- **Multi-Device Management:** Users can view and revoke specific active tokens/devices from their dashboard.  

### 🛒 E-Commerce Logic
- **Dynamic Catalog:** Advanced product filtering by categories, price ranges, and best-sellers.  
- **Order Management:** Atomic transactions for order placement, ensuring data integrity across `orders` and `order_items`.  
- **Payment Integration:** Pre-configured for **Stripe** and **PayPal** gateways.  
- **Automated Notifications:** Event-driven emails for order confirmations using Mailtrap/Brevo (SMTP/API).  

---

## 🗄️ Database Mastery (SQL)
- **Optimized Indexing:** Custom migrations for performance-critical indexes on products and orders.  
- **Stored Procedures:** Server-side logic utilized for complex data aggregations and analytics.  
- **Eloquent Relationships:** Masterful use of One-to-Many, BelongsTo, and Eager Loading to eliminate N+1 query performance issues.  
- **Database Constraints:** Strict foreign key constraints and cascading logic to ensure relational health.  

---

## 🛡️ Security Implementation
- **SQLi Prevention:** Absolute use of Eloquent ORM and PDO Parameterized Queries for all database interactions.  
- **Brute Force Protection:** Dedicated RateLimiter logic in the Auth API targets specific IP and login combinations.  
- **Data Protection:** Sensitive information (Passwords, 2FA Secrets) is always hashed/encrypted using Argon2 or AES-256.  
- **Cross-Site Protection:** Full CSRF, XSS, and CORS middleware configurations in place.  

---

## 🌐 API Documentation (v1)
The system exposes a professional RESTful API under the `/api/v1/` prefix.

| Method | Endpoint | Access | Purpose |
| ------ | -------- | ------ | ------- |
| POST   | `/login` | Public | Authenticate & get bearer token |
| GET    | `/products` | Public | Fetch catalog with filters |
| GET    | `/user` | Sanctum | Retrieve authenticated profile |
| POST   | `/orders` | Customer | Place a new order |
| GET    | `/admin/stats` | Admin | Dashboard analytics |

---

## 🛠️ Tech Stack
- **Backend:** Laravel 12, PHP 8.2+  
- **Frontend:** Livewire 3, Tailwind CSS, Alpine.js  
- **Database:** MySQL / SQLite  
- **APIs:** Laravel Sanctum (Token-based Auth)  
- **Payments:** Stripe PHP SDK, srmklive/paypal  
- **Tools:** Vite, Composer, Artisan  

---

## 🚀 Installation & Setup

### 1️⃣ Clone the repository
```bash
git clone https://github.com/salmamuzam/aaliyahs-collection-ecom.git
cd aaliyahs-collection-ecom
```

### 2️⃣ Install PHP Dependencies
```bash
composer install
```

### 3️⃣ Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4️⃣ Run Migrations & Seeders
```bash
php artisan migrate --seed
```

### 5️⃣ Install Frontend Assets
```bash
npm install && npm run build
```

### 6️⃣ Start the Server
```bash
php artisan serve
```

---

## 📂 Folder Structure
```text
app/
├── Http/Controllers/Api   # RESTful API v1 logic
├── Livewire/              # Reactive Web Components
├── Models/                # Eloquent Models & Relationships
├── Providers/             # App logic, Event Listeners, Gates

database/
├── migrations/            # SQL Schemas, Indexes, Procedures
├── seeders/               # Initial Production & Test Data

routes/
├── api.php                # Sanctum Protected API Routes
└── web.php                # Jetstream Protected Web Routes
```
