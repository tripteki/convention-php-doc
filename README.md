<h1 align="center">Convention</h1>

Trip Teknologi's Codebase Convention.

Getting Started
---

Installation :

```
$ composer require tripteki/laravelphp-docs
```

How to use :

- Put `Tripteki\Docs\Providers\DocsServiceProvider::ignoreConfig()` into `register` provider, then publish config file into your project's directory with running (optionally) :

```
php artisan vendor:publish --tag=tripteki-laravelphp-docs-config
```

- Put the comment onto the `App\Http\Controllers\Controller` :

```
/**
 * @OA\Info(
 *      title="Application Programming Interface",
 *      version="1.0"
 * ),
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT"
 * )
 */
```

Usage
---

`php artisan swagger:generate`

Author
---

- Trip Teknologi ([@tripteki](https://linkedin.com/company/tripteki))
- Hasby Maulana ([@hsbmaulana](https://linkedin.com/in/hsbmaulana))
