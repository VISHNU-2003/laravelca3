<p align="center"><img src="/public/img/logo.png" width="400"></p>

## About this Laravel app

Simple Todo List app with Api-Rest made with Laravel.
- User registration (Jetstream)
- Dynamic interface (Livewire, AlpineJS)
- Token based API (Sanctum)
- Design (Tailwind)

## Screenshots

<p><img src="/public/img/screenshot.gif"></p>

API REST

<p><img src="/public/img/s01.jpg" width="400"></p>
<p><img src="/public/img/s02.jpg" width="400"></p>
<p><img src="/public/img/s03.jpg" width="400"></p>
<p><img src="/public/img/s04.jpg" width="400"></p>
<p><img src="/public/img/s05.jpg" width="400"></p>

## Installation

Please check the official Laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/10.x/installation)

Clone the repository

    git clone https://github.com/benzuri/laravel-todo-list.git

Switch to the app folder

    cd laravel-todo-list

Install all the dependencies using composer

    composer install

Make the required configuration changes in the .env file if you need

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate:fresh

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000
