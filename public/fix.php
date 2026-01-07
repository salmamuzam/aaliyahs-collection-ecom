<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Attempting Database Fix...</h1>";

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

try {
    echo "<p>Clearing caches...</p>";
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    echo "<pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";

    echo "<p>Running Migrations...</p>";
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    echo "<pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";

    echo "<h2 style='color:green'>Done! Go to <a href='/'>Homepage</a></h2>";
} catch (\Throwable $e) {
    echo "<h1>Error</h1><pre>" . $e->getMessage() . "\n" . $e->getTraceAsString() . "</pre>";
}
