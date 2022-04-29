# gmj-laravel_block2_content

Laravel Block for backend and frontend - need tailwindcss support

**composer require gmj/laravel_block2_content**

package for test<br>
composer.json#autoload-dev#psr-4: "GMJ\\LaravelBlock2Content\\": "package/laravel_block2_content/src/",<br>
config > app.php > providers: GMJ\LaravelBlock2Content\LaravelBlock2ContentServiceProvider::class,
in terminal run: composer dump-autoload

---

in terminal run:

```
php artisan vendor:publish --provider="GMJ\LaravelBlock2Content\LaravelBlock2ContentServiceProvider" --force
php artisan migrate
php artisan db:seed --class=LaravelBlock2ContentSeeder
```
