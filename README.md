# Romanian BookLink

This is Romanian BookLink, the book e-commerce project that I build for the final exam. It was build using Laravel 11, Livewire 3, Alpinejs, Tailwind, PHP 8.2 and Filament 3.

## Prerequisites
- PHP 8.2
- Livewire 2
- Alpinejs
- Tailwind
- Filament 3
- Composer
- NPM

## Installation

### Install PHP Dependencies:           `composer install`
### Install Node Dependencies:          `npm install`
### Setup Environmental Configuration:  `copy .env.example to .env`
### Generate Application Key:           `php artisan key:generate`

### Database:

The project was realized having MySql as database.

---------------------------------------------------------------------------------------------------

## Configure your .env file
    STRIPE_SECRET=your_stripe_secret

---------------------------------------------------------------------------------------------------

## Run Project

### Setup Database:         `php artisan migrate --seed`
### Compile Assets:         `npm run dev`
### Serve the Application:  `php artisan serve`
