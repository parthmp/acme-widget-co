# Acme Widget Co

A PHP-based shopping basket system demonstrating modern software engineering practices with clean architecture, dependency injection, and comprehensive testing.

## How It Works

The system implements a flexible shopping basket with the following components:

### Core Classes

**Basket** - The main shopping basket class that:
- Manages a product catalogue with prices
- Handles adding items to the basket
- Calculates totals including delivery charges
- Applies special offers automatically
- Uses cents internally to avoid floating-point arithmetic issues

**DeliveryCharge** - Implements delivery charge calculation:
- Free delivery for orders ≥ $90.00
- $2.95 delivery for orders ≥ $50.00
- $4.95 delivery for orders < $50.00

**SpecialOffer** - Implements "buy one, get one half price" offers:
- Applies to specified product codes
- Automatically reduces the price of the second item by 50%

### Architecture Features

The system uses several design patterns and best practices:

- **Strategy Pattern**: Delivery charges and offers are pluggable via interfaces
- **Dependency Injection**: All dependencies are injected through constructors
- **Interface Segregation**: Small, focused interfaces for different responsibilities
- **Type Safety**: Comprehensive type hints and PHPDoc annotations
- **Precision Handling**: Uses integer cents internally to avoid floating-point errors

### Test Cases

The included tests demonstrate various scenarios:
- Two R01 items: $54.37 (second R01 half price + delivery)
- B01 + G01: $37.85 (standard pricing + delivery)  
- R01 + G01: $60.85 (standard pricing + delivery)
- Complex basket: $98.27 (multiple items with offers applied)

## How to Use

### With Dockerfile

```bash
git clone https://github.com/parthmp/acme-widget-co.git
cd acme-widget-co
docker build -t acme-app .
docker run --rm -it acme-app bash
vendor/bin/phpunit tests/BasketTest.php
```

### With Docker Compose

```bash
git clone https://github.com/parthmp/acme-widget-co.git
cd acme-widget-co
docker compose up -d --build
docker compose exec app bash
vendor/bin/phpunit tests/BasketTest.php
```

### Without Docker

```bash
git clone https://github.com/parthmp/acme-widget-co.git
cd acme-widget-co
composer install

# Linux/Mac
vendor/bin/phpunit tests/BasketTest.php

# Windows
vendor\bin\phpunit tests\BasketTest.php
```

## Technologies & Practices Demonstrated

This repository showcases modern PHP development practices:

- **Composer** - Dependency management and autoloading
- **PHPUnit** - Unit and integration testing framework
- **PHPStan** - Static analysis for type safety and code quality
- **Docker** - Containerized development environment
- **Docker Compose** - Multi-container application orchestration
- **Dependency Injection** - Loose coupling and testability
- **Strategy Pattern** - Flexible, extensible design
- **Sensible Types** - Strong typing with comprehensive annotations
- **Source Control** - Git-based version control and code review workflows
- **Good Separation/Encapsulation** - Clear boundaries between components
- **Small Accurate Interfaces** - Focused, single-responsibility contracts

## Product Catalogue

The system includes three sample products:
- **R01**: Red Widget - $32.95
- **G01**: Green Widget - $24.95  
- **B01**: Blue Widget - $7.95

## Example Usage

```php
// Create basket with catalogue, delivery rules, and offers
$basket = new Basket(
    ['R01' => 32.95, 'G01' => 24.95, 'B01' => 7.95],
    new DeliveryCharge(),
    new SpecialOffer('R01')
);

// Add items
$basket->add('R01');
$basket->add('R01'); // Second R01 will be half price

// Calculate total (includes delivery)
$total = $basket->total(); // $54.37
```