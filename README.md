# KingExpressBus

Bus ticket booking platform connecting passengers with high-quality bus operators. Built with Laravel 12.

## Project Overview

KingExpressBus is a comprehensive solution for managing bus transportation services. It provides:
-   **Admin Portal:** For platform management, master data control, and company oversight.
-   **Company Portal:** For bus operators to manage their fleet, routes, schedules, and bookings.
-   **Client Portal:** A user-friendly interface for customers to search for trips, view details, and book tickets.

## Documentation

-   [Project Overview & Requirements](docs/project-overview-pdr.md)
-   [Codebase Summary](docs/codebase-summary.md)
-   [System Architecture](docs/system-architecture.md)
-   [Coding Standards](docs/code-standards.md)

## Requirements

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL

## Installation & Setup

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/yourusername/kingexpressbus.git
    cd kingexpressbus
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install Frontend dependencies:**
    ```bash
    npm install
    ```

4.  **Environment Configuration:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Update `.env` with your database credentials.*

5.  **Database Migration:**
    ```bash
    php artisan migrate
    ```

6.  **Run the application:**
    ```bash
    # Run backend and frontend build in parallel
    npm run dev
    ```
    *Or run them separately:*
    ```bash
    php artisan serve
    npm run dev
    ```

## Key Features

-   **Multi-Role System:** Admin, Company, Customer.
-   **Dynamic Routing:** Management of Provinces, Districts, and specific Stops.
-   **Booking System:** Complete flow from search to payment status tracking.
-   **Localization:** Support for English and Vietnamese.
-   **Media Management:** Integration with CKFinder.

## License

MIT License.
