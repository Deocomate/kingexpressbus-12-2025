# King Express Bus Admin System - Code Standards & Guidelines

## Table of Contents

1. [General Principles](#1-general-principles)
2. [PHP Coding Standards](#2-php-coding-standards)
3. [Laravel Best Practices](#3-laravel-best-practices)
4. [Frontend Standards](#4-frontend-standards)
5. [Database Standards](#5-database-standards)
6. [Testing Standards](#6-testing-standards)
7. [Security Standards](#7-security-standards)
8. [Documentation Standards](#8-documentation-standards)
9. [Git Workflow](#9-git-workflow)
10. [Code Review Process](#10-code-review-process)

## 1. General Principles

### 1.1 Core Philosophy
- **Readability First**: Code is read more than it's written
- **Consistency**: Maintain consistent patterns throughout the codebase
- **Simplicity**: Prefer simple solutions over complex ones
- **Testing**: Write tests as you write code
- **Documentation**: Document complex logic and design decisions

### 1.2 Development Workflow
1. Create feature branch from `develop`
2. Implement changes following standards
3. Write tests for new functionality
4. Run code quality checks
5. Submit pull request for review
6. Address review feedback
7. Merge to `develop` after approval

## 2. PHP Coding Standards

### 2.1 PSR-12 Compliance
- Follow PSR-12 coding standards strictly
- Use spaces for indentation (4 spaces)
- No tabs allowed
- Max line length: 120 characters

### 2.2 File Structure
```php
<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
```

### 2.3 Naming Conventions

#### Classes
- PascalCase (e.g., `UserController`)
- Prefer singular names for models
- Use meaningful names that describe purpose

#### Methods
- camelCase (e.g., `getUserBookings`)
- Verb-based for actions (e.g., `createBooking`, `updateUser`)
- Query methods should start with appropriate verb (get, find, create, update, delete)

#### Properties
- camelCase for private/protected (e.g., `$userEmail`)
- underscore prefix for private (e.g., `$_internalCache`)
- meaningful names that describe the data

#### Constants
- UPPER_SNAKE_CASE (e.g., `MAX_BOOKING_ATTEMPTS`)
- Use class constants for magic numbers and configuration

### 2.4 Method Guidelines

- Keep methods under 50 lines when possible
- Single responsibility principle
- Use type hints consistently
- Return early for error conditions
- Use dependency injection

### 2.5 Error Handling
- Use exceptions appropriately
- Catch specific exception types
- Log exceptions with context
- Provide user-friendly error messages

### 2.6 Documentation Standards

#### PHPDoc Blocks
```php
/**
 * Get all bookings for a specific user.
 *
 * @param int $userId The user ID to retrieve bookings for
 * @return \Illuminate\Database\Eloquent\Collection
 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
 */
public function getUserBookings(int $userId): \Illuminate\Database\Eloquent\Collection
{
    // Implementation
}
```

#### Block Comments
- Use for complex logic sections
- Explain the "why" not the "what"
- Keep comments up to date with code

#### Inline Comments
- Use sparingly
- Explain non-obvious code
- Avoid stating the obvious

## 3. Laravel Best Practices

### 3.1 Controllers
- Keep controllers thin and focused
- Move business logic to services
- Use resource controllers for RESTful operations
- Validate input in controllers

### 3.2 Models
- Use fillable/guarded properties
- Implement relationships properly
- Use accessors and mutators for data transformation
- Keep models focused on data persistence

### 3.3 Services
- Create service classes for business logic
- Use dependency injection
- Implement interfaces for testability
- Handle transactions appropriately

### 3.4 Middleware
- Create middleware for cross-cutting concerns
- Keep middleware focused on single responsibility
- Use route middleware for specific endpoints
- Implement proper error handling

### 3.5 Validation
- Use Form Request classes for complex validation
- Implement custom validation rules when needed
- Provide clear error messages
- Validate both for API and web requests

### 3.6 Database Patterns
- Use migrations for schema changes
- Implement proper indexes
- Use soft deletes where appropriate
- Follow naming conventions for database tables and columns

### 3.7 Eloquent Patterns
- Use relationship methods properly
- Implement scopes for common queries
- Use eager loading to avoid N+1 problems
- Implement proper polymorphic relationships when needed

## 4. Frontend Standards

### 4.1 Blade Templates

#### Structure
```blade
{{-- File: resources/views/admin/users/index.blade.php --}}

@extends('admin.layouts.app')

@section('title', 'User Management')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User List</h3>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.errors')

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ route('admin.users.edit', $user->id }}"
                                                   class="btn btn-sm btn-primary">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @push('scripts')
        <script>
            // JavaScript code here
        </script>
    @endpush
@endsection
```

#### Blade Guidelines
- Use meaningful section names
- Keep components modular and reusable
- Use proper indentation
- Include error messages consistently
- Use URL helpers for routes

### 4.2 CSS Standards

#### Tailwind CSS (Client Portal)
- Use utility-first classes
- Follow Tailwind's design system
- Extend theme colors in config
- Use custom CSS sparingly

#### Bootstrap / AdminLTE (Admin & Company Portals)
- Follow Bootstrap 4 utility classes
- Use AdminLTE components for layout and widgets
- Avoid overriding AdminLTE styles unless necessary
- Use standard Bootstrap spacing and grid classes

#### Custom CSS
- Use BEM methodology when needed
- Keep classes specific to components
- Avoid !important
- Use CSS variables for theming

### 4.3 JavaScript Standards

#### File Organization
- Keep JavaScript in resources/js directory
- Use ES6+ features
- Use modules for organization
- Minify for production

#### Code Style
```javascript
// Use semicolons consistently
// Use const/let instead of var
// Use descriptive variable names
// Use arrow functions when appropriate

class BookingManager {
    constructor(apiService) {
        this.apiService = apiService;
        this.bookings = [];
    }

    async fetchBookings(userId) {
        try {
            const response = await this.apiService.get(`/bookings/${userId}`);
            this.bookings = response.data;
            return this.bookings;
        } catch (error) {
            console.error('Failed to fetch bookings:', error);
            throw error;
        }
    }
}
```

### 4.4 Component Development (Blade & Alpine.js)
- **Blade Components**:
  - Use anonymous components for simple UI elements (`<x-button>`)
  - Use class-based components for complex logic
  - Keep views clean by moving logic to component classes
- **Alpine.js**:
  - Use for interactive UI elements (modals, dropdowns, toggles)
  - Keep state local to the component
  - Extract complex logic into Alpine data objects

## 5. Database Standards

### 5.1 Migration Standards

#### Migration File Naming
- Use descriptive names: `add_phone_number_to_users_table.php`
- Include timestamp: `2024_01_01_000000_create_users_table.php`

#### Migration Content
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
```

### 5.2 Table and Column Names
- Use snake_case for tables and columns
- Be descriptive but concise
- Use singular names for tables (except junction tables)
- Follow naming conventions for foreign keys

### 5.3 Index Strategy
- Index foreign keys
- Index frequently queried columns
- Consider composite indexes for common query patterns
- Avoid over-indexing

### 5.4 Relationships
```php
// One-to-Many
public function buses()
{
    return $this->hasMany(Bus::class);
}

// Many-to-Many
public function routes()
{
    return $this->belongsToMany(Route::class);
}

// Polymorphic
public function imageable()
{
    return $this->morphTo();
}
```

## 6. Testing Standards

### 6.1 Testing Framework
- Use Pest PHP for testing
- Follow PHPUnit standards where applicable
- Maintain high test coverage

### 6.2 Test Organization
```
tests/
├── Feature/
│   ├── Auth/
│   ├── Booking/
│   ├── Company/
│   └── User/
├── Unit/
│   ├── Models/
│   └── Support/
└── TestCase.php
```

### 6.3 Test Writing Guidelines

#### Feature Tests
```php
it('can create a new booking', function () {
    // Arrange
    $user = User::factory()->create();
    $route = Route::factory()->create();

    // Act
    $response = $this->actingAs($user)
        ->post('/bookings', [
            'route_id' => $route->id,
            'seat_number' => 'A1',
            'passenger_name' => 'John Doe',
        ]);

    // Assert
    $response->assertStatus(201);
    $this->assertDatabaseHas('bookings', [
        'user_id' => $user->id,
        'route_id' => $route->id,
    ]);
});
```

#### Unit Tests
```php
test('Booking Model calculates total price correctly', function () {
    // Arrange
    $route = Route::factory()->create(['price' => 10000]);
    $booking = new Booking();
    $booking->route()->associate($route);
    $seatCount = 2;

    // Act
    $totalPrice = $booking->calculateTotalPrice($seatCount);

    // Assert
    expect($totalPrice)->toBe(20000);
});
```

### 6.4 Testing Best Practices
- Test both success and failure cases
- Use factories for test data
- Mock external services
- Test edge cases
- Keep tests fast and isolated

## 7. Security Standards

### 7.1 Authentication
- Use Laravel Sanctum for API authentication
- Implement proper session management
- Use strong password hashing
- Implement rate limiting

### 7.2 Authorization
- Use policies for authorization
- Check permissions in middleware
- Follow least privilege principle
- Log authorization attempts

### 7.3 Input Validation
- Validate all user input
- Use Form Request classes
- Sanitize output
- Use proper field types

### 7.4 SQL Injection Prevention
- Use Eloquent ORM
- Use query builders safely
- Avoid raw SQL when possible
- Use parameterized queries

### 7.5 XSS Prevention
- Escape output in Blade
- Use HTML Purifier for rich text
- Sanitize user content
- Set proper CSP headers

## 8. Documentation Standards

### 8.1 API Documentation
- Use OpenAPI/Swagger standards
- Document all endpoints
- Include request/response examples
- Document authentication requirements

### 8.2 Code Documentation
- Write clear PHPDoc blocks
- Document complex business logic
- Update documentation with code changes
- Use meaningful variable and function names

### 8.3 README Files
- Include setup instructions
- Document development workflow
- List dependencies
- Provide troubleshooting information

## 9. Git Workflow

### 9.1 Branch Naming
- Use descriptive branch names
- Prefix with feature/ or bugfix/
- Include issue number when applicable
- Examples: `feature/user-authentication`, `bugfix/booking-validation`

### 9.2 Commit Messages
- Follow conventional commits format
- Use present tense
- Include scope when appropriate
- Be descriptive but concise

#### Examples
```
feat: add multi-language support for booking system
fix: resolve booking status update issue
docs: update API documentation
refactor: optimize database queries
test: add booking validation tests
```

### 9.3 Pull Requests
- Include detailed description
- Link to related issues
- Update documentation if needed
- Ensure tests pass
- Address review comments promptly

## 10. Code Review Process

### 10.1 Review Checklist
- [ ] Code follows standards
- [ ] Tests are included and passing
- [ ] Documentation is updated
- [ ] Security considerations addressed
- [ ] Performance implications considered
- [ ] Code is reviewed for readability
- [ ] Edge cases are handled

### 10.2 Review Guidelines
- Be constructive in feedback
- Focus on code quality and standards
- Ask questions about unclear parts
- Suggest improvements respectfully
- Approve only when all criteria are met

### 10.3 Quality Gates
- Automated tests must pass
- Code quality checks must pass
- Security scans must pass
- Performance tests must meet requirements

---

*Standards Version: 1.0.0*
*Last Updated: 2025-12-10*
