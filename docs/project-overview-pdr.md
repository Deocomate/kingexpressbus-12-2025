# Project Overview & Product Development Requirements (PDR)

## 1. Project Overview
**KingExpressBus** is a comprehensive bus ticket booking platform designed to connect passengers with bus operators. The system facilitates the management of bus routes, schedules, and bookings, providing distinct interfaces for platform administrators, bus companies, and end-users (customers).

### Key Objectives
-   **Centralized Management:** Allow platform admins to manage locations, generic routes, and platform settings.
-   **Operator Autonomy:** Enable bus companies to manage their own fleets, specific routes, schedules, and pricing.
-   **User Convenience:** Provide a seamless booking experience for customers with search, seat selection, and payment options.

## 2. Stakeholders & Roles
-   **Administrator (Admin):** Platform owner with full access to system configurations, master data (locations), and oversight of all companies and bookings.
-   **Company (Bus Operator):** Transport service providers who manage their specific buses, routes, schedules, and view their own bookings.
-   **Customer (Client):** End-users who search for trips, book tickets, and manage their travel history.

## 3. Product Development Requirements (PDR)

### 3.1 Functional Requirements

#### A. Authentication & Authorization
-   **Multi-guard Auth:** Distinct authentication flows for Admin, Company, and Customer.
-   **Registration:** Public registration for Customers. Admin/Company account creation (likely internal or admin-managed).
-   **Profile Management:** Users can update personal information and passwords.

#### B. Admin Module
-   **Dashboard:** System-wide statistics.
-   **Website Configuration:** Manage logo, SEO settings, contact info, and menus via `web_profiles` and `menus`.
-   **Location Management:** CRUD for Provinces, Districts, Stops, and District Types.
-   **Route Management:** Define generic routes (Start Province -> End Province).
-   **Company Management:** Onboard and manage bus operator accounts.
-   **Booking Oversight:** View and manage all bookings across the platform.

#### C. Company Module
-   **Dashboard:** Operator-specific statistics.
-   **Fleet Management:** Manage Buses (`buses`) including seat maps and amenities.
-   **Route Operations:**
    -   Create `company_routes` based on generic routes.
    -   Define specific stops (`company_route_stops`) with pickup/drop-off logic.
    -   Manage `bus_routes` (specific trips with time and price).
-   **Booking Management:** View and update status of bookings for their own trips.

#### D. Client (Customer) Module
-   **Search & Discovery:** Search trips by origin, destination, and date.
-   **Route Details:** View bus details, amenities, photos, and policies.
-   **Booking Flow:**
    -   Select Route -> Select Seat (implied by schema) -> Enter Info -> Payment.
    -   Support for multiple payment methods (Online Banking, Cash on Pickup).
-   **Localization:** Switch between Vietnamese (vi) and English (en).
-   **Static Pages:** About Us, Contact, Articles.

### 3.2 Non-Functional Requirements
-   **Performance:** Optimized for fast search results.
-   **SEO:** Dynamic meta tags for routes and locations.
-   **Scalability:** Database design supports multiple companies and routes.
-   **Security:** Role-based access control (RBAC) middleware (`AdminAuthMiddleware`, `CompanyAuthMiddleware`, `CustomerAuthMiddleware`).

## 4. Roadmap (Inferred)
-   **Phase 1 (MVP):** Core booking flow, basic admin/company panels, manual payment confirmation.
-   **Phase 2:** Advanced seat selection (visual), Payment Gateway integration.
-   **Phase 3:** Mobile App API, Loyalty program.
