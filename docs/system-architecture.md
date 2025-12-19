# King Express Bus Admin System - System Architecture

## Table of Contents

1. [Architecture Overview](#1-architecture-overview)
2. [Design Patterns](#2-design-patterns)
3. [Component Architecture](#3-component-architecture)
4. [Data Flow](#4-data-flow)
5. [Security Architecture](#5-security-architecture)
6. [Performance Architecture](#6-performance-architecture)
7. [Scalability Considerations](#7-scalability-considerations)
8. [Deployment Architecture](#8-deployment-architecture)
9. [Monitoring and Observability](#9-monitoring-and-observability)
10. [Future Architecture Evolution](#10-future-architecture-evolution)

## 1. Architecture Overview

### 1.1 High-Level Architecture

The King Express Bus Admin System follows a **Layered MVC Architecture**. The system is designed to be modular, scalable, and maintainable, with business logic primarily residing in Controllers and Models, supported by Helper classes.

```
┌─────────────────────────────────────────────────────────────┐
│                        Presentation Layer                     │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐         │
│  │   Admin UI  │  │  Company UI  │  │  Client UI  │         │
│  └─────────────┘  └─────────────┘  └─────────────┘         │
└─────────────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────────────┐
│                      Controller Layer                        │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐         │
│  │  Admin Ctrl │  │ Company Ctrl│  │  Client Ctrl│         │
│  └─────────────┘  └─────────────┘  └─────────────┘         │
└─────────────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────────────┐
│                      Domain Layer                           │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐          │
│  │   User      │  │   Booking   │  │   Route     │          │
│  │   Models    │  │   Models    │  │   Models    │          │
│  └─────────────┘  └─────────────┘  └─────────────┘          │
└─────────────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────────────┐
│                      Infrastructure Layer                     │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐         │
│  │    MySQL    │  │   Redis     │  │   File      │         │
│  │    Database │  │   Cache     │  │   Storage   │         │
│  └─────────────┘  └─────────────┘  └─────────────┘         │
└─────────────────────────────────────────────────────────────┘
```

### 1.2 Architecture Principles

- **Separation of Concerns**: Clear separation between presentation, business logic, and data access
- **Single Responsibility**: Each component has a single, well-defined purpose
- **Dependency Inversion**: Dependencies flow toward abstractions
- **Open/Closed**: Open for extension, closed for modification
- **Don't Repeat Yourself (DRY)**: Common functionality is centralized
- **Interface Segregation**: Clients should not depend on interfaces they don't use

## 2. Design Patterns

### 2.1 MVC Pattern
The core architecture follows the Model-View-Controller pattern:

- **Models**: Represent business data and logic
- **Views**: Handle presentation and user interface
- **Controllers**: Manage user input and coordinate between models and views

### 2.2 Repository Pattern (Optional/Implicit)
While not strictly enforced, the application uses Eloquent ORM which implements the Active Record pattern, acting as a repository for database interactions.

```php
// Example of Active Record usage in Controller
public function show($id)
{
    $booking = Booking::with('user', 'route')->findOrFail($id);
    return view('booking.show', compact('booking'));
}
```

### 2.3 Support/Helper Classes
Complex logic that doesn't fit neatly into Models or Controllers is placed in Support classes (e.g., `App\Support\Client\SearchDataBuilder`).

```php
class SearchDataBuilder
{
    public function build(Request $request)
    {
        // Complex search logic construction
    }
}
```
### 2.4 Observer Pattern
Event-driven architecture using Laravel's event system:

```php
class Booking
{
    protected static function boot()
    {
        parent::boot();

        static::created(function ($booking) {
            // Logic to handle booking creation event
        });

        static::updated(function ($booking) {
            // Logic to handle booking update event
        });
    }
}
```

### 2.5 Strategy Pattern
For different payment processors:

```php
interface PaymentStrategy
{
    public function processPayment(array $paymentData): PaymentResult;
}

class OnlineBankingPayment implements PaymentStrategy
{
    public function processPayment(array $paymentData): PaymentResult
    {
        // Online banking payment logic
    }
}

class CashPayment implements PaymentStrategy
{
    public function processPayment(array $paymentData): PaymentResult
    {
        // Cash payment logic
    }
}
```

### 2.6 Factory Pattern
For creating complex objects:

```php
class BookingFactory
{
    public static function create(array $data): Booking
    {
        $booking = new Booking();
        $booking->user_id = $data['user_id'];
        $booking->route_id = $data['route_id'];
        $booking->status = 'pending';
        $booking->total_price = self::calculateTotal($data);

        return $booking;
    }
}
```

## 3. Component Architecture

### 3.1 Authentication Component

#### Architecture
```
┌─────────────────────────────────────────────────────┐
│                    Auth Gateway                      │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Login Form │  │ Sanctum    │  │ Middleware │   │
│  │            │  │ Tokens     │  │ (Guard)    │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────┐
│                   Auth Controller                    │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Login      │  │ Register   │  │ Logout     │   │
│  │ Logic      │  │ Logic      │  │ Logic      │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────┐
│                   Storage Layer                     │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Users      │  │ Sessions   │  │ Personal   │   │
│  │ Table       │  │ Table      │  │ Access     │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
```

#### Features
- Multi-role authentication (Admin, Company, Customer)
- JWT token-based API access
- Session-based web access
- Role-based access control (RBAC)
- Rate limiting for authentication

### 3.2 Geographic Component

#### Architecture
```
┌─────────────────────────────────────────────────────┐
│                    Geographic API                    │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Search     │  │ Get Details │  │ Validate   │   │
│  │ Locations  │  │ Location   │  │ Addresses  │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────┐
│                  Geographic Controller               │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Province   │  │ District    │  │ Stop       │   │
│  │ Logic      │  │ Logic       │  │ Logic      │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────┐
│                   Database Layer                    │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Provinces  │  │ Districts  │  │ Stops       │   │
│  │ Table       │  │ Table      │  │ Table       │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
```

#### Features
- Hierarchical location structure (Province → District → Stop)
- Location search and filtering
- Distance calculations
- Geographic data validation
- Multi-language location names

### 3.3 Booking Component

#### Architecture
```
┌─────────────────────────────────────────────────────┐
│                   Booking API                        │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Search     │  │ Book       │  │ Manage     │   │
│  │ Routes     │  │ Ticket     │  │ Booking   │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────┐
│                   Booking Service                   │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Seat       │  │ Payment     │  │ Validation │   │
│  │ Manager    │  │ Processor   │  │ Engine     │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────┐
│                   Domain Layer                      │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Routes     │  │ Bookings   │  │ Seats      │   │
│  │            │  │            │  │            │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
```

#### Features
- Real-time seat availability
- Multi-stop route booking
- Payment processing integration
- Booking status management
- Hotel pickup coordination

### 3.4 Company Management Component

#### Architecture
```
┌─────────────────────────────────────────────────────┐
│                Company Management API                │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Profile    │  │ Fleet       │  │ Routes     │   │
│  │ Mgmt        │  │ Mgmt        │  │ Mgmt       │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────┐
│                Company Service                      │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Admin      │  │ Fleet       │  │ Route      │   │
│  │ Service     │  │ Service     │  │ Service    │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────┐
│                   Data Layer                        │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Companies  │  │ Buses       │  │ Routes     │   │
│  │ Table       │  │ Table       │  │ Table      │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
```

#### Features
- Company profile management
- Bus fleet management
- Route configuration
- Schedule management
- Analytics and reporting

### 3.3 Frontend Architecture

#### Hybrid Approach
The system utilizes a hybrid frontend architecture to optimize for different user needs:

- **Client Portal (Passenger)**:
  - **Technology**: Blade Templates + Tailwind CSS v4 + Alpine.js
  - **Goal**: High performance, modern UI/UX, mobile responsiveness
  - **Structure**: Component-based Blade views with utility-first CSS

- **Admin & Company Portals**:
  - **Technology**: Blade Templates + Bootstrap 4 + AdminLTE 3 + jQuery
  - **Goal**: Rapid development, robust data tables, familiar admin interface
  - **Structure**: Layout-based views with pre-built admin components

## 4. Data Flow

### 4.1 Request Processing Flow

```
User Request → Router → Middleware → Controller
    ↓
Validation → Service Layer → Repository
    ↓
Database → Service → Controller → View/API Response
```

### 4.2 Booking Flow Example

```
1. User searches for routes
   Client → RouteController@search → Route Model

2. Select route and seats
   Client → BookingController@create → Booking Model

3. Process payment
   BookingController → Payment Logic (in Controller/Support)

4. Confirm booking
   BookingController → Booking Model → Notification (Mail)

5. Update UI
   Response to Client with booking details
```

### 4.3 Event-Driven Architecture

```php
// Events
BookingCreated → EmailNotification, SMSNotification, AnalyticsTracking
BookingPaid → SeatLock, InvoiceGeneration, RevenueTracking
BookingCancelled → SeatRelease, RefundProcessing, CancellationAnalytics

// Listeners
EmailNotificationListener → SendBookingConfirmation
SMSNotificationListener → SendBookingSMS
AnalyticsTrackingListener → TrackBookingMetrics
```

## 5. Security Architecture

### 5.1 Security Layers

```
┌─────────────────────────────────────────────────────┐
│                   Network Layer                      │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ HTTPS/TLS   │  │ Firewall   │  │ WAF        │   │
│  │ Encryption  │  │ Rules      │  │ Protection │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────┐
│                   Application Layer                   │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Auth        │  │ Input      │  │ Rate       │   │
│  │ Middleware  │  │ Validation │  │ Limiting   │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────┐
│                   Data Layer                         │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ SQL         │  │ Data       │  │ File       │   │
│  │ Injection   │  │ Encryption │  │ Access     │   │
│  │ Prevention  │  │ (at rest)  │  │ Control    │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
```

### 5.2 Authentication & Authorization

#### Authentication Methods
- **Web Sessions**: Laravel's session management
- **API Tokens**: Laravel Sanctum for API access
- **OAuth**: Ready for future third-party integrations

#### Authorization Strategy
- **Role-Based Access Control (RBAC)**
- **Policy-Based Authorization**
- **Resource-Level Permissions**

### 5.3 Data Protection

#### Encryption
- **Password Hashing**: Bcrypt with strong work factor
- **Session Data**: Encrypted with Laravel's encryption
- **Database**: SSL/TLS for database connections
- **File Storage**: Encrypted at rest for sensitive files

#### Input Sanitization
- **Request Validation**: Form Request classes
- **Output Encoding**: Blade auto-escaping
- **XSS Prevention**: Content Security Policy headers
- **SQL Injection Prevention**: Eloquent ORM and query builders

## 6. Performance Architecture

### 6.1 Caching Strategy

```
┌─────────────────────────────────────────────────────┐
│                   Cache Hierarchy                    │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Browser    │  │ CDN/       │  │ Application│   │
│  │ Cache      │  │ Edge Cache  │  │ Cache      │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────┐
│                   Cache Types                        │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Redis      │  │ Memcached   │  │ File       │   │
│  │ (Sessions) │  │ (Queries)  │  │ (Views)    │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
```

#### Cache Implementation
- **Redis**: Session storage and cache
- **Query Caching**: Eloquent query results
- **View Caching**: Compiled Blade templates
- **Route Caching**: Compiled route definitions
- **Configuration Caching**: Merged configuration files

### 6.2 Database Optimization

#### Query Optimization
- **Proper Indexing**: Strategic indexes on frequently queried columns
- **Eager Loading**: Prevent N+1 queries with relationships
- **Query Caching**: Cache expensive query results
- **Pagination**: Use cursor or simple pagination for large datasets

#### Database Configuration
- **Connection Pooling**: Efficient connection management
- **Read Replicas**: Ready for read scaling
- **Database Backups**: Automated backup strategy

### 6.3 Asset Optimization

#### Frontend Assets
- **Vite**: Modern build tool with code splitting
- **Minification**: CSS, JS, and image optimization
- **Lazy Loading**: Images and components
- **Compression**: Gzip/Brotli compression

## 7. Scalability Considerations

### 7.1 Horizontal Scaling

#### Application Server
- **Stateless Sessions**: Use Redis for session storage
- **Load Balancing**: Ready for multiple application servers
- **Auto-scaling**: Cloud provider integration ready

#### Database Scaling
- **Read Replicas**: For read-heavy workloads
- **Sharding Strategy**: For massive scale
- **Connection Pooling**: Efficient database connections

### 7.2 Microservices Readiness

#### Service Boundaries
- **User Service**: Authentication and user management
- **Booking Service**: Booking and payment processing
- **Route Service**: Route management and geographic data
- **Notification Service**: Email and SMS notifications

#### Communication Patterns
- **REST APIs**: For synchronous communication
- **Message Queues**: For asynchronous processing
- **Event Streaming**: For real-time updates

## 8. Deployment Architecture

### 8.1 Environment Configuration

```
┌─────────────────────────────────────────────────────┐
│                   Production Environment               │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Load       │  │ Web Servers │  │ Application│   │
│  │ Balancer   │  │ (PHP-FPM)   │  │ Servers    │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────┐
│                   Data Layer                        │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐   │
│  │ Database   │  │ Redis       │  │ File       │   │
│  │ Cluster    │  │ Cluster     │  │ Storage    │   │
│  └─────────────┘  └─────────────┘  └─────────────┘   │
└─────────────────────────────────────────────────────┘
```

### 8.2 CI/CD Pipeline

#### Stages
1. **Code Commit**: Git push triggers pipeline
2. **Static Analysis**: Code quality and security checks
3. **Unit Testing**: Automated unit and feature tests
4. **Integration Testing**: Database and API tests
5. **Build**: Asset compilation and deployment
6. **Deployment**: Staged deployment to production

### 8.3 Infrastructure as Code

#### Configuration Management
- **Docker**: Containerization for consistency
- **Kubernetes**: Orchestration for scalability
- **Terraform**: Infrastructure provisioning
- **Ansible**: Configuration management

## 9. Monitoring and Observability

### 9.1 Logging Architecture

#### Log Levels
- **DEBUG**: Detailed debugging information
- **INFO**: General application flow
- **WARNING**: Exceptional occurrences
- **ERROR**: Runtime errors
- **CRITICAL**: Critical application failures

#### Log Aggregation
- **File Logging**: Local development logs
- **Structured Logging**: JSON format for production
- **Log Shipping**: Centralized log management
- **Log Analysis**: Search and alerting capabilities

### 9.2 Monitoring

#### Application Monitoring
- **Performance Metrics**: Response times, throughput
- **Error Tracking**: Exception monitoring
- **Health Checks**: Application and dependency health
- **Custom Metrics**: Business-specific metrics

#### Infrastructure Monitoring
- **Server Metrics**: CPU, memory, disk usage
- **Database Metrics**: Query performance, connections
- **Network Metrics**: Bandwidth, latency
- **Application Metrics**: Request rates, error rates

### 9.3 Alerting

#### Alert Categories
- **Critical System Failures**: Immediate notification
- **Performance Degradation**: Performance thresholds
- **Security Events**: Security breach attempts
- **Business Metrics**: Important business events

## 10. Future Architecture Evolution

### 10.1 Planned Enhancements

#### Microservices Migration
- **Phase 1**: Extract booking service
- **Phase 2**: Extract user service
- **Phase 3**: Extract notification service
- **Phase 4**: Full microservices architecture

#### Technology Upgrades
- **API Gateway**: Centralized API management
- **Service Mesh**: Advanced service communication
- **GraphQL**: Flexible API querying
- **Serverless**: Event-driven architecture

### 10.2 Scalability Roadmap

#### Short-term (6 months)
- Implement Redis clustering
- Add read replicas
- Optimize database queries
- Implement caching layers

#### Medium-term (12 months)
- Containerize application
- Implement CI/CD improvements
- Add advanced monitoring
- Performance optimization

#### Long-term (24 months)
- Full microservices architecture
- Global deployment strategy
- Advanced caching strategies
- AI/ML integration

---

*Architecture Version: 1.0.0*
*Last Updated: 2025-12-10*
