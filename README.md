# King Express Bus Platform

A comprehensive, multi-tenant bus transportation management system built with **Laravel 12** and **PHP 8.2+**. This platform connects passengers, bus companies, and system administrators through three distinct interfaces, facilitating seamless booking experiences and efficient fleet operations.

## 📚 Documentation

For detailed information about the project, please refer to the documentation in the `docs/` directory:

-   [**Project Overview & PDR**](docs/project-overview-pdr.md): High-level goals, features, and requirements.
-   [**System Architecture**](docs/system-architecture.md): In-depth look at the architectural design, database schema, and core components.
-   [**Codebase Summary**](docs/codebase-summary.md): A tour of the project structure and key directories.
-   [**Code Standards**](docs/code-standards.md): Guidelines for writing clean, consistent, and maintainable code.
-   [**Deployment Guide**](docs/deployment-guide.md): Instructions for deploying the application.
-   [**Design Guidelines**](docs/design-guidelines.md): Frontend design and UI/UX principles.
-   [**Project Roadmap**](docs/project-roadmap.md): Future plans and upcoming features.

## 🚀 Tech Stack

-   **Backend**: Laravel 12, PHP 8.2+, MySQL
-   **Frontend**: Blade, Tailwind CSS, Bootstrap 4 (AdminLTE), Vite
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
    git clone https://github.com/your-org/kingexpressbus.git
    cd kingexpressbus
    ```

2.  **Install dependencies**:
    ```bash
    composer install
    npm install
    ```

3.  **Set up the environment**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Update `.env` with your database credentials.*

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

## 🤝 Contributing

Contributions are welcome! Please read our [Code Standards](docs/code-standards.md) before submitting a pull request.

## 📄 License

This project is licensed under the MIT License.
