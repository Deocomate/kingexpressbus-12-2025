# King Express Bus Platform

A comprehensive, multi-tenant bus transportation management system built with **Laravel 12** and **PHP 8.2+**. This platform connects passengers, bus companies, and system administrators through three distinct interfaces, facilitating seamless booking experiences and efficient fleet operations.

## 📚 Documentation

For detailed information about the project, please refer to the documentation in the `docs/` directory:

-   [**Project Overview & PDR**](docs/project-overview-pdr.md): High-level goals, features, and requirements.
-   [**System Architecture**](docs/system-architecture.md): In-depth look at the architectural design, database schema, and core components.
-   [**Codebase Summary**](docs/codebase-summary.md): A tour of the project structure and key directories.
-   [**Code Standards**](docs/code-standards.md): Guidelines for writing clean, consistent, and maintainable code.

## 🚀 Tech Stack

-   **Backend**: Laravel 12, PHP 8.2+, MySQL
-   **Frontend**: Blade, Tailwind CSS, Bootstrap 4 (AdminLTE)
-   **Testing**: Pest PHP
-   **File Management**: CKFinder

## 🛠 Quick Start

### Prerequisites

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL

### Installation

1.  **Clone the repository**:

    ```bash
    git clone https://github.com/Deocomate/kingexpressbus-12-2025.git
    cd kingexpressbus-12-2025
    ```

2.  **Install dependencies**:

    ```bash
    composer update
    composer install
    npm install
    ```

3.  **Set up the environment**:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    _Update `.env` with your database credentials._

4.  **Run migrations and seed the database**:

    ```bash
    php artisan migrate --seed
    ```

5.  **Link storage**:

    ```bash
    php artisan storage:link
    ```

6.  **Build assets and run the development server**:
    ```bash
    npm run dev & php artisan serve
    ```

Access the application at `http://localhost:8000`.

## 🚀 Production Deployment & Optimization

When deploying your application to a production server, follow these steps to ensure optimal performance:

1.  **Install Composer Dependencies**:
    Install only the necessary packages for a production environment, excluding development tools.

    ```bash
    composer install --optimize-autoloader --no-dev
    ```

2.  **Migrate And Optimize**:

    ```bash
    php artisan migrate:fresh --seed
    php artisan optimize:clear
    php artisan optimize
    ```

3.  **Run Production Optimizations**:
    Execute Laravel's built-in optimization commands to cache configurations, routes, and views. This significantly improves performance by reducing the framework's boot time.

    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
    ```

4.  **Clear Development Caches**:
    If you previously ran any caching commands in your development environment, clear them to avoid conflicts.

    ```bash
    php artisan config:clear
    php artisan route:clear
    php artisan view:clear
    php artisan event:clear
    ```

5.  **Enable Maintenance Mode** (Optional):
    If you need to perform maintenance tasks, you can put your application into maintenance mode.
    ```bash
    php artisan down
    ```
    To bring it back online:
    ```bash
    php artisan up
    ```

By following these steps, your Laravel application will be optimized for a production environment, providing faster response times and a better user experience.

## 📄 License

This project is licensed under the MIT License.
