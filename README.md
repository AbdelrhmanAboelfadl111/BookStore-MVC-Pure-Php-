# 📚 Book Store | Full-Stack Web Application

A complete **Book Store web application** built with **Pure PHP**, without using Laravel or any other PHP framework.

The project was developed to understand how a modern web application works internally by building the **MVC architecture, routing system, middleware, validation, request/response handling, and database layer from scratch**.

---

## 🚀 About The Project

The Book Store is a full-stack web application that provides a structured platform for managing books, authors, users, orders, and order items.

The main focus of this project was not only building the application itself, but also understanding the architecture and communication between its different layers.

### 🔄 Application Flow

```text
Client Request
      ↓
   Router
      ↓
 Middleware
      ↓
 Controller
      ↓
    Model
      ↓
   Database
      ↓
    Model
      ↓
   Controller
      ↓
     View
      ↓
   Response
```

---

## 🏗️ Architecture

The project follows a custom **MVC architecture built from scratch using Pure PHP**.

### 📂 Main Structure

```text
BookStore/
│
├── app/
│   ├── controllers/
│   ├── models/
│   ├── views/
│   ├── middlewares/
│   └── helpers/
│
├── core/
│   ├── App.php
│   ├── Router.php
│   ├── Request.php
│   ├── Response.php
│   ├── Database.php
│   └── Validator.php
│
├── config/
│
├── public/
│   ├── index.php
│   ├── css/
│   ├── js/
│   └── assets/
│
└── README.md
```

---

## ⚙️ Core Features

- Custom MVC Architecture
- Custom Routing System
- Web & API Routes
- Request & Response Handling
- Middleware System
- Authentication & Authorization
- Form Validation
- Session Management
- CRUD Operations
- Book Management
- Author Management
- User Management
- Shopping Cart
- Order Management
- Order Items Management
- Admin Dashboard
- Search & Filtering
- Pagination
- Database Relationships
- Reusable Helpers

---

## 🛠️ Technologies & Tools

### Front-End

<p align="left">
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" width="45" height="45" alt="HTML5"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" width="45" height="45" alt="CSS3"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" width="45" height="45" alt="JavaScript"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/jquery/jquery-original.svg" width="45" height="45" alt="jQuery"/>
</p>

**HTML5 • CSS3 • JavaScript • jQuery**

### Back-End

<p align="left">
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" width="50" height="50" alt="PHP"/>
</p>

**Pure PHP**

No Laravel or PHP framework was used.

The MVC architecture and core application components were implemented manually.

### Database

<p align="left">
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" width="50" height="50" alt="MySQL"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/phpmyadmin/phpmyadmin-original.svg" width="50" height="50" alt="phpMyAdmin"/>
</p>

**MySQL • SQL • phpMyAdmin**

---

## 🗄️ Database

The application uses **MySQL** as its primary database.

Main entities include:

```text
Users
  │
  ├── Orders
  │      │
  │      └── Order Items
  │
Books
  │
  ├── Authors
  │
  └── Order Items
```

The database was designed to maintain relationships between:

- Users
- Books
- Authors
- Orders
- Order Items

---

## 🔐 Authentication & Authorization

The application includes authentication and authorization mechanisms to control access to different areas of the system.

The project uses middleware to separate authentication and authorization logic from the main application controllers.

```text
Request
   ↓
Authentication Middleware
   ↓
Authorization Middleware
   ↓
Controller
```

---

## 📦 Project Concepts

This project helped me gain a deeper understanding of:

- MVC Architecture
- Object-Oriented PHP
- HTTP Request/Response Lifecycle
- Routing
- Middleware
- Authentication
- Authorization
- Sessions
- Database Connectivity
- SQL Queries
- CRUD Operations
- Database Relationships
- Separation of Concerns
- Backend Architecture
- Front-End / Back-End Communication

---

## 🎯 Project Goal

The primary goal was to understand what happens **behind the abstractions provided by PHP frameworks**.

Instead of depending on Laravel's built-in:

```text
Routing
Controllers
Middleware
Validation
Database Layer
Request / Response
```

these concepts were implemented manually using **Pure PHP**.

---

## 💻 Installation

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/AbdelrhmanAboelfadl111/BookStore-MVC-Pure-Php-.git
```

### 2️⃣ Move the Project

Place the project inside your local server directory.

For example:

```text
laragon/www/BookStore
```

### 3️⃣ Create The Database

Create a MySQL database using:

```text
phpMyAdmin
```

Then import the provided SQL database file.

### 4️⃣ Configure Database Connection

Update your database configuration with your local credentials:

```php
DB_HOST = "127.0.0.1";
DB_NAME = "book_store";
DB_USER = "root";
DB_PASSWORD = "";
```

### 5️⃣ Run The Project

Start your local server and open:

```text
http://localhost/BookStore/public
```

---

## 📸 Screenshots

> Add project screenshots here to showcase the interface.

```text
screenshots/
├── home.png
├── books.png
├── book-details.png
├── cart.png
├── orders.png
└── dashboard.png
```

---

## 📚 What I Learned

Working on this project gave me practical experience with the internal structure of web applications and helped me understand how different layers communicate with each other.

From:

**HTTP Request → Router → Middleware → Controller → Model → Database → View → Response**

every layer was implemented and connected as part of the application architecture.

---

## 👨‍💻 Author

**Abdelrahman Abolfadl**

Front-End Developer | Full-Stack Developer

GitHub:  
https://github.com/AbdelrhmanAboelfadl111

---

## 🤝 Special Thanks

Special thanks to:

**SemiCodeTech**  
For providing the learning environment and project experience.

**Mohamed Atya**  
Instructor

**Jana Abdelrhim**  
Mentor

---

## ⭐ Support

If you find this project useful or interesting, consider giving the repository a ⭐.

---

### 🧰 Tech Stack

`PHP` `MySQL` `SQL` `phpMyAdmin` `HTML5` `CSS3` `JavaScript` `jQuery` `MVC` `REST API`