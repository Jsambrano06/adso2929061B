<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$pet = new \App\Models\Pet();
print_r($pet->getFillable());

try {
    \App\Models\Pet::create([
        'name' => 'TestFix',
        'kind' => 'Perro',
        'bread' => 'Beagle',
        'weight' => 0,
        'age' => 0,
        'location' => '',
        'description' => '',
        'image' => 'no-image.png',
        'active' => true,
        'adopted' => false,
    ]);
} catch (\Exception $e) {
    echo "SQL ERROR:\n";
    echo $e->getMessage();
}

