# Coding Standards & Conventions

## 1. General Guidelines
This project follows **PSR-12** coding standards and standard Laravel best practices.

### PHP Version
-   **Required:** PHP 8.2 or higher.

## 2. Naming Conventions

### Classes & Files
-   **Controllers:** `PascalCase` suffix with `Controller` (e.g., `BusRouteController`).
-   **Models:** `PascalCase` singular (e.g., `Bus`, `CompanyRoute`).
-   **Migrations:** `snake_case` timestamped (e.g., `2025_09_22_..._create_bookings_table`).

### Database
-   **Tables:** `snake_case` plural (e.g., `company_routes`, `bus_services`).
-   **Columns:** `snake_case` (e.g., `start_time`, `is_active`).
-   **Foreign Keys:** `singular_table_id` (e.g., `company_id`, `pickup_stop_id`).

### Routes
-   **Names:** `kebab-case` with dot notation for nesting (e.g., `admin.bus-services.index`).
-   **URIs:** `kebab-case` (e.g., `/tuyen-duong`, `/company-routes`).

## 3. Architectural Patterns

### Controller Responsibility
-   Controllers should be thin. Business logic should be delegated to Services or Models where appropriate.
-   **Resource Controllers:** Use standard resource methods (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`) where possible.

### View Structure (Inferred)
-   Views should be organized by module:
    -   `resources/views/admin/`
    -   `resources/views/company/`
    -   `resources/views/client/`

## 4. Git & Version Control
-   **Commit Messages:** Descriptive, imperative mood (e.g., "Add booking validation", "Fix route calculation").
-   **Branches:** Feature branch workflow (`feature/name`, `fix/issue`).
