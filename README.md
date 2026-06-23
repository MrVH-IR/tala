🪙 Gold & Market Trading Panel

    A lightweight trading panel built with Laravel 12, Livewire, Alpine.js, and MySQL for real-time pricing and simulated asset purchasing (Gold, Currency, Crypto).

🚀 Overview

    This project simulates a simple financial trading interface where users can:
    
    Browse live market prices (Gold, Currency, Crypto)
    Select an asset category
    Choose a specific instrument
    Enter purchase amount (grams or fiat value)
    See real-time calculated totals
    Simulate a buy operation (backend processing ready)
    
    The system is designed to be extendable into a full trading or fintech platform.

⚙️ Tech Stack

    Laravel 12 – Backend framework
    Livewire 3 – Reactive UI without heavy JavaScript
    Alpine.js – Lightweight frontend interactions
    MySQL – Database layer
    TailwindCSS – UI styling
    External API – Market price provider (Gold/Currency/Crypto)

📊 Features
📈 Market Data

    Gold prices (18K, 24K, melted gold)
    Fiat currencies (USD, EUR, etc.)
    Cryptocurrencies (BTC, ETH, etc.)
    Cached API responses for performance optimization

🛒 Buying System

    Select asset category (Gold / Currency / Crypto)
    Select specific item (e.g. IR_GOLD_18K)
    Input purchase amount:
    grams
    units
    or fiat value (Toman mode)
    Automatic price calculation
    Real-time total update

⚡ UX / UI

    Responsive card-based design
    Dark mode support
    Clean step-based selection flow
    Live updates without page refresh (Livewire)

🧠 Business Logic

    Dynamic price adjustment (markup support)
    Unit-based calculation logic
    Minimum purchase rules (extendable)
    Safe numeric parsing for financial inputs

⚙️ Environment Variables

Update .env:
```shell
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_pass

BRS_API_KEY=your_api_key
```
```shell
git clone https://github.com/mrvh-ir/tala.git
cd tala

composer install
npm install && npm run build

cp .env.example .env
php artisan key:generate
php artisan migrate --seed
composer run dev
```

🧩 Architecture Notes

    Livewire Component Structure
    BuyComponent handles:
    Category switching
    Item selection
    Price calculation
    Total computation
    API Layer
    External market API is wrapped inside a service class:
    Cached requests
    JSON normalization
    Markup application (e.g. +1% gold price)

📌 Future Improvements

    Order persistence system
    User wallet / balance system
    Real trading engine (limit / market orders)
    Admin panel for price control
    Audit logs for transactions
🧪 Project Purpose

This project is designed as:

    A fintech UI/UX experiment
    A Livewire architecture showcase
    A foundation for trading systems
    A portfolio-grade backend project
🧑‍💻 Author

Built by a backend developer focused on:

    Laravel architecture
    Clean backend design
    Real-time UI systems
    Scalable fintech applications
