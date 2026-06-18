# Employee CRUD Application

A simple PHP + MySQL web application for managing employee records, with user registration and login to gate access to the admin panel. Built with vanilla PHP (`mysqli`) on the backend and Tailwind CSS (via CDN) for the UI.

## Features

- **User authentication** — register and log in before accessing the employee panel
- **Password security** — passwords hashed with `password_hash()` / verified with `password_verify()`
- **Employee management (CRUD)**
  - **C**reate — add new employees with name, email, role, job title, and salary
  - **R**ead — view all employees in a dashboard table with a live employee count
  - **U**pdate — edit any employee's details via a pre-filled form
  - **D**elete — remove an employee record (with a confirmation prompt)
- **Session-based access control** using PHP `$_SESSION`
- **Logout** that destroys the session and redirects to login
- Responsive, modern UI styled with Tailwind CSS and Font Awesome icons

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP (procedural, `mysqli`) |
| Database | MySQL |
| Frontend | HTML, Tailwind CSS (CDN), Font Awesome (CDN), custom CSS |
| Fonts | Google Fonts (Inter) |

## Project Structure

```
Employee_crud/
├── components/
│   ├── config.php       # Database connection
│   └── sidebar.php      # Shared sidebar/layout markup
├── employee/
│   ├── index.php        # Employee list (dashboard / Read)
│   ├── create.php       # Add new employee (Create)
│   ├── edit.php         # Edit existing employee (Update)
│   └── delete.php       # Delete employee (Delete)
├── form/
│   ├── login.php        # User login
│   ├── register.php     # User registration
│   └── logout.php       # Destroys session, redirects to login
└── style/
    ├── style.css         # Dashboard styling
    └── style1.css        # Login/registration form styling
```

## Database Setup

The app expects a MySQL database named **`registration`** with two tables: one for application users (`registered`) and one for employee records (`employee`).

```sql
CREATE DATABASE IF NOT EXISTS registration;
USE registration;

-- Application users (for login/registration)
CREATE TABLE registered (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    father_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Employee records (managed via the CRUD panel)
CREATE TABLE employee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role VARCHAR(50) NOT NULL,
    job_title VARCHAR(100) NOT NULL,
    salary DECIMAL(10,2) NOT NULL
);
```

`components/config.php` connects with these defaults — update them to match your environment:

```php
$conn = mysqli_connect("localhost", "root", "", "registration");
```

| Parameter | Default |
|---|---|
| Host | `localhost` |
| Username | `root` |
| Password | *(empty)* |
| Database | `registration` |

## Installation

1. Clone or copy the project into your web server's document root (e.g., `htdocs` for XAMPP, `www` for WAMP).
2. Start Apache and MySQL.
3. Create the `registration` database and the two tables above (or import them via phpMyAdmin).
4. Adjust credentials in `components/config.php` if needed.
5. Open the app in your browser:
   - Register a user: `form/register.php`
   - Log in: `form/login.php`
   - After login, you're redirected to the employee dashboard: `employee/index.php`

## Application Flow

1. **Register** at `form/register.php` — name, father's name, email, and password are collected; the email is checked for uniqueness and the password is hashed before being stored in `registered`.
2. **Log in** at `form/login.php` — credentials are checked against `registered`; on success, `user_id` and `user_name` are stored in the session and the user is redirected to the employee dashboard.
3. **Manage employees** at `employee/index.php`:
   - View all employees and the total employee count
   - **Add** via `create.php`
   - **Edit** via `edit.php?id={id}`
   - **Delete** via `delete.php?id={id}` (prompts for confirmation in the browser)
4. **Log out** via `form/logout.php`, which clears the session and returns to the login page.

## Known Issues & Recommended Improvements

The app is a functional learning/demo project, but several things should be addressed before any production use:

1. **SQL injection vulnerabilities** — `create.php`, `edit.php`, and `delete.php` build SQL queries by directly concatenating `$_POST`/`$_GET` values (no escaping or prepared statements). This includes the `id` parameter in `edit.php` and `delete.php`, which is taken straight from the URL. Switch all queries to **prepared statements** (`mysqli_prepare` + `bind_param`).
2. **No route protection** — `employee/index.php`, `create.php`, `edit.php`, and `delete.php` don't check `$_SESSION['user_id']` before running. Anyone with the URL can view or modify employee data without logging in. Add a session check (e.g., redirect to `login.php` if not authenticated) at the top of each protected page.
3. **XSS risk** — employee fields (`name`, `last_name`, `email`, `role`, `job_title`) are echoed directly into HTML without escaping (`htmlspecialchars()`), allowing stored XSS if malicious input is submitted.
4. **No input validation** — beyond HTML `required` attributes (client-side only), there's no server-side validation of email format, salary as a number, etc.
5. **No CSRF protection** — forms (especially `delete.php`, which performs a destructive GET-based action) have no CSRF tokens.
6. **GET-based delete** — using a simple link (`delete.php?id=...`) for a destructive action means it could be triggered by a crawler, prefetch, or accidental click; the JS `confirm()` only helps against accidental clicks, not security.
7. **Hardcoded credentials** — database credentials live in plain text in `config.php`. Use environment variables or a `.env` file excluded from version control.
8. **No `.gitignore` / license** — consider adding a `.gitignore` (to exclude local config/secrets) and a license file if the project will be shared or open-sourced.

## License

This project is provided as-is for educational purposes. Add a license of your choice if distributing publicly.
