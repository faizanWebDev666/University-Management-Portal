<?php

// Test if middleware exists
$middlewareClass = 'App\Http\Middleware\SessionInactivityTimeout';

if (class_exists($middlewareClass)) {
    echo "✅ SUCCESS: Middleware class exists and can be loaded!\n";
    echo "Class: " . $middlewareClass . "\n";
    
    $reflection = new ReflectionClass($middlewareClass);
    echo "File: " . $reflection->getFileName() . "\n";
    echo "Method handle: " . ($reflection->hasMethod('handle') ? 'EXISTS' : 'MISSING') . "\n";
} else {
    echo "❌ ERROR: Middleware class not found!\n";
}
