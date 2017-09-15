# Context Service Provider


## Install & setup
- Install
`composer require bonnier/context-laravel`
- Add to `config/app.php`
```php
'providers' => [
    ...,
    Bonnier\ContextService\ContextServiceProvider::class,
    ...
],
```
- Add middleware to `app/Http/Kernel.php`
```php
protected $middleware = [
    ...,
    \Bonnier\ContextService\Middleware\RegisterContext::class,
];
```