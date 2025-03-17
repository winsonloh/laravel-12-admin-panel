# Laravel 12 Admin Panel

🔥 **A lightweight and customizable Laravel 12 Admin Panel** with built-in **user management, role-based access control (RBAC), and localization support**.

This panel is based on **Laravel Breeze**, enhanced with **Spatie Role & Permission** and a **custom route structure (`admin.php`)**, making it ideal for **admin dashboards, SaaS projects, and internal CRM systems**.

---

## 🚀 Key Features
✅ **User & Role Management** – Uses **Spatie Role & Permission** for advanced access control  
✅ **Custom Routing** – Admin panel routes are organized in `routes/admin.php`  
✅ **Localization Support** – Easily switch between multiple languages  
✅ **Pre-built UI Components** – Includes **Tables, Multi-Select**, and basic styling for easy customization  
✅ **Latest Laravel 12** – Fully compatible with **Laravel 12** for long-term support  
✅ **Lightweight & Simple** – Does not rely on **Nova / Filament**, making it easy to modify and extend  

---

## 📦 Installation
```bash
git clone https://github.com/winsonloh/laravel-12-admin-panel.git
cd laravel-12-admin-panel
composer install
npm install && npm run dev
php artisan migrate --seed
php artisan serve
```
---

## 🛠 Tech Stack
Backend: Laravel 12 (PHP 8+)  
Frontend: Tailwind CSS, Blade Templates  
Authentication: Laravel Breeze  
Role-Based Access Control: Laravel Gates & Policies  

---

## 📝 Usage Guide

1️⃣ Admin Panel Login  
Default Admin Credentials (after seeding the database):  
Path: ```/admin/login```  
Username: ```super_admin```  
Password: ```password```  

2️⃣ Role & Permission Management (Spatie Package)  
Manage roles and permissions via Spatie Role & Permission  
Assign different roles to users with specific access levels  
Protect routes using Laravel Gates & Policies

3️⃣ Custom Admin Routing (admin.php)  
All admin routes are stored in ```routes/admin.php```  
Keeps admin panel routing separate from frontend routes

4️⃣ Localization Support  
Easily switch languages via ```resources/lang/```  
Supports multilingual UI

---

## 🤝 Contributing
Feel free to contribute! Open a pull request or submit an issue if you find a bug or have a feature request.

---

## ⭐ Support the Project
If you find this project useful, consider giving it a ⭐ on GitHub!

---

## 📩 Contact
For inquiries or collaboration opportunities, reach out via winson.loh94@gmail.com.

---

## 📜 License
This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.
