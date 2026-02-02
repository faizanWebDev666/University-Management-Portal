<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Course;

$course = Course::create([
    'course_name' => 'AutoUUIDScript',
    'course_code' => 'SCRIPT' . rand(1000,9999),
    'credit_hours' => '3',
    'description' => 'created by script',
]);

echo "Created course id={$course->id} uuid={$course->uuid}\n";