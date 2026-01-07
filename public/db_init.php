<?php

// Only allow execution if a specific query param is present (simple security)
// Usage: /db_init.php?key=secret123

if (!isset($_GET['key']) || $_GET['key'] !== 'secret123') {
    die('Access Denied');
}

define('LARAVEL_START', microtime(true));

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Boot the app to load service providers (database, etc)
$kernel->bootstrap();

echo "<h1>Database Initializer</h1>";

try {
    echo "<p>connection: " . config('database.default') . "</p>";
    echo "<p>host: " . config('database.connections.mysql.host') . "</p>";
    echo "<p>database: " . config('database.connections.mysql.database') . "</p>";

    echo "<h2>Running Migrations...</h2>";
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    echo "<pre style='background:#eee;padding:10px;'>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";

    echo "<h2>Running Seeders...</h2>";
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
    echo "<pre style='background:#eee;padding:10px;'>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";

    echo "<h2 style='color:green'>SUCCESS! You can visit the homepage now.</h2>";

} catch (\Throwable $e) {
    echo "<h2 style='color:red'>ERROR:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
