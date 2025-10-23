# 📈 Stock Analysis Platform Setup Guide

This guide provides step-by-step instructions for setting up the **Stock Analysis Platform**, a Laravel application, on your local development environment.

## Prerequisites

Ensure your system meets the following requirements before proceeding:

| Software | Minimum Requirement (Recommended) | Purpose |
| :--- | :--- | :--- |
| **PHP** | 8.2+ | The core language for Laravel. |
| **Composer** | Latest Stable | PHP Dependency Management. |
| **Node.js** & **npm/Yarn** | 18+ / Latest Stable | For compiling front-end assets (CSS/JS). |
| **Database** | MySQL, PostgreSQL, or SQLite | Data storage for the application. |
| **Web Server** | Apache/Nginx or PHP's Built-in Server | To serve the application. |
| **Git** | Latest Stable | For cloning the project repository. |

**Recommended Setup:** For the easiest local environment setup, consider using **Laravel Herd** (macOS/Windows) or **Laravel Sail** (Docker-based).

***

## 1. Installation

### 1.1. Clone the Repository

Clone the project from its remote Git source:

```bash
git clone git@github.com:henrymanyonyi/stock-analysis.git
````

### 1.2. Navigate to Project Directory

Move into the new project folder:

```bash
cd stock-analysis
```

### 1.3. Install PHP Dependencies

Use **Composer** to download and install all backend dependencies:

```bash
composer install
```

### 1.4. Install JavaScript Dependencies

Use **npm** (or **Yarn**) to install the necessary frontend packages:

```bash
npm install
# OR
# yarn install
```

-----

## 2\. Configuration

### 2.1. Environment File and Key

1.  Duplicate the example environment file to create your local configuration:

    ```bash
    cp .env.example .env
    ```

2.  Generate a unique, secure application encryption key:

    ```bash
    php artisan key:generate
    ```

    This command automatically updates the `APP_KEY` in your `.env` file.

### 2.2. Database Setup

Open the `.env` file and configure your database connection.

  * If using **SQLite**, you just need to ensure the `DB_CONNECTION=sqlite` and run `touch database/database.sqlite`.
  * If using **MySQL/PostgreSQL**, update the following with your credentials:

<!-- end list -->

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stock_analysis_db # Create this database manually
DB_USERNAME=root
DB_PASSWORD=
```

-----

## 3\. Database & Assets

### 3.1. Run Migrations

Run the database migrations to create all required tables:

```bash
php artisan migrate
```

### 3.2. Compile Frontend Assets

Compile the application's CSS and JavaScript for development:

```bash
npm run dev
# For production deployment, use: npm run build
```

-----

## 4\. Running the Application

### 4.1. Start the Server

Start the Laravel development server using the Artisan command:

```bash
php artisan serve
```

Your **Stock Analysis Platform** should now be running and accessible in your web browser at:

👉 **`http://127.0.0.1:8000`**

### 4.2. Important Next Steps


1.  **Authentication:** You can now register a new user and log in with credentials you provided.
2.  **Upload stocks csv:** Upload the stock csv.
3.  **View stock analysis on the dashboard:** View analyzed stock on dashbaord.

