### Laravel Vue SPA Admin-panel

## Install
- `git clone https://github.com/pahomovdima/laravel-vue-spa-admin`
- `cd laravel-vue-spa-skeleton`
- `composer install`
- `cp .env.example .env` - copy .env file
- set your DB credentials in `.env`
- `php artisan key:generate`
- `php artisan jwt:secret --force`
- `php artisan migrate`

- `npm install`

## Usage
- `npm run watch` or `npm run hot` - for hot reloading
- `php artisan serve` and go [127.0.0.1:8000](http://127.0.0.1:8000)

- Create new user and login.

### Creating module
You can easily create module with CRUD functionality.
 
`php artisan make:module {ModuleName}`

This will create: 

- **migration** `database/migrations/000_00_00_000000_create_{ModuleName}_table.php`

- **model** `app/Models/{ModuleName}.php`

- **factory** `database/factories/{ModuleName}Factory.php`

- **tests** `tests/Feature/{ModuleName}Test.php`

- **backend module** `app/Modules/{ModuleName}/`
```
{ModuleName}/
│
├── routes_api.php
│
├── Controllers/
│   └── {ModuleName}Controller.php
│
├── Requests/
│   └── {ModuleName}Request.php
│
└── Resources/
    └── {ModuleName}Resource.php
```

- **frontend module** `resources/js/modules/{moduleName}/`
```
{moduleName}/
│
├── routes.js
│
├── api/
│   └── index.js
│
├── components/
│   ├── {ModuleName}List.vue
│   ├── {ModuleName}View.vue
│   └── {ModuleName}Form.vue
│
└── store/
    ├── store.js
    ├── types.js
    └── actions.js
```


> After creating module, you can edit model and migration by adding fields you need. 
> Also you can add this fields into view.
> Don't forget run php artisan migrate.

Every module loads dynamically.
