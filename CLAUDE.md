# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Advanced Facturation is a Laravel 8 invoicing system developed by Advanced IT and Research Burundi. It integrates with the OBR (Office Burundais des Recettes) API for electronic tax declaration in Burundi.

**Tech Stack:** PHP 7.4+/8.1+, Laravel 8.12, Vue 2, Inertia.js, Livewire, Tailwind CSS, MySQL/PostgreSQL

## Common Commands

```bash
# Development
composer install          # Install PHP dependencies
npm install               # Install JS dependencies
npm run dev               # Build assets for development
npm run watch             # Watch mode with auto-rebuild
npm run hot               # Hot module replacement

# Database
php artisan migrate       # Run migrations
php artisan db:seed       # Seed database
php artisan migrate:fresh --seed  # Reset and seed

# Testing
php artisan test          # Run all tests
./vendor/bin/phpunit      # Alternative test runner
./vendor/bin/phpunit tests/Feature/ExampleTest.php  # Single test file
./vendor/bin/phpunit --filter test_method_name      # Single test method

# Server
php artisan serve         # Start development server (localhost:8000)

# Cache
php artisan cache:clear   # Clear application cache
php artisan config:clear  # Clear config cache
php artisan view:clear    # Clear view cache
```

## Architecture

### Core Domain Models

- **Order** - Invoices with OBR signature, linked to Client and DetailOrder items
- **Product** - Catalog items with TVA rates (0%, 10%, 18%) and pricing
- **Client** - Customers/suppliers with prepaid account (Compte) support
- **Stocke** - Stock locations for multi-stock management
- **ObrDeclaration/ObrPointer** - OBR sync status and response tracking

### OBR Integration

The OBR API integration is critical to this application. Key components:

- **SendInvoiceToOBR** class (`app/Http/Controllers/`) - Core API client with methods:
  - `getToken()` - Authentication
  - `sendInvoice()` - Submit invoices
  - `addStockMovement()` - Sync stock
  - `cancelInvoice()` - Revoke invoices
- **ObrSendInvoince** job - Async invoice submission queue job
- **ObrDeclarationController** - Invoice management and OBR sync UI
- **SyncronizeController** - Bulk data synchronization

API environments configured via `.env`:
- Production: `https://ebms.obr.gov.bi:8443/ebms_api/`
- Staging: `https://ebms.obr.gov.bi:9443/ebms_api/`

### Key Feature Modules

| Module | Controllers | Purpose |
|--------|-------------|---------|
| Invoicing | VenteController, OrderController, CheckoutController | Sales and invoice generation |
| Stock | StockController, ProductStockController | Inventory management with OBR sync |
| Accounts | CompteController | Prepaid client account management |
| Location | MaisonLocationController, PaymentLocationMensuelController | Property rental tracking |
| Reports | RapportController, DepenseController | Financial reporting and expenses |

### API Routes

REST API at `/api/*` with Sanctum authentication:
- Auth: `/api/login`, `/api/register`
- Resources: users, organisations, members, transactions, documents
- Protected routes require Bearer token

Advanced module routes at `/advanced/*` for extended features.

## Configuration

### Environment Variables

Key `.env` settings:

```env
# OBR Integration
OBR_USERNAME=           # OBR API username
OBR_PASSWORD=           # OBR API password
OBR_NIF=               # Company tax ID
OBR_CAN_SYNCRONISE=    # Enable/disable sync
OBR_PRODUCTION=        # true for production API

# Feature Toggles
APP_USE_ABONEMENT=     # Subscription management
APP_USE_LOCATION=      # Rental module
APP_USE_LOGO=          # Company branding
APP_CAN_USE_TVA=       # VAT calculations
APP_CAN_USE_MULTI_STOCK=  # Multi-location stock
```

### Helper Constants

In `app/Helpers/confuguration.php`:
- `TAUX_TVA` - Available VAT rates: [0, 10, 18]
- `TYPE_DEVISE` - Currencies: BIF, USD, EUR
- `PARTAGE_*` - Revenue sharing percentages
- `TEMPS_GENERATION_FACTURE` - Invoice timeout (60s)

## Patterns

### Model Conventions

- All main models use `SoftDeletes` - check queries when filtering
- Models auto-fill `user_id` via `DependOnUser` trait
- Invoice numbers generated via `getInvoiceNumber()` helper
- Global search via `SearchOnModel` trait

### Livewire Components

25 real-time components in `app/Http/Livewire/` for:
- Stock management (ProductStockComponent)
- Payment processing (PaymentPartielle, PaymentMensuel)
- Reports (Tax, RapportRevenu)
- Location management (AddClient, HistoriquePayment)

### Excel Import/Export

Uses `maatwebsite/excel`:
- Exports in `app/Exports/`
- Imports in `app/Imports/`
- Routes: `/export_model`, `/import_data`

## Deployment

GitHub Actions workflow (`.github/workflows/deploy.yml`) auto-deploys on push to `advanced` branch via SSH.

Main branches:
- `main` - Production releases
- `advanced` - Active development
