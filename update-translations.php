<?php

$resources = [
    'AdResource.php',
    'CategoryResource.php',
    'CommentResource.php',
    'ContactResource.php',
    'CustomerResource.php',
    'NewsResource.php',
    'SocialCountResource.php',
    'SubscriberResource.php',
    'TagResource.php',
];

$resourceDir = __DIR__ . '/app/Filament/Resources/';

// Common patterns to replace
$patterns = [
    // Labels
    "/->label\('([^']+)'\)/" => function($matches) {
        $label = $matches[1];
        if (in_array(strtolower($label), ['id', 'name', 'email', 'title', 'created at', 'updated at', 'status'])) {
            return "->label(__('filament::" . strtolower(str_replace(' ', '_', $label)) . "'))";
        }
        return $matches[0];
    },
    
    // Placeholders
    "/->placeholder\('([^']+)'\)/" => function($matches) {
        $text = $matches[1];
        if (in_array(strtolower($text), ['all', 'select an option', 'search...'])) {
            return "->placeholder(__('filament::" . strtolower(str_replace(' ', '_', $text)) . "'))";
        }
        return $matches[0];
    },
    
    // Action buttons
    "/Action::make\('([^']+)'\)/" => function($matches) {
        $action = strtolower($matches[1]);
        $translations = [
            'edit' => 'edit',
            'delete' => 'delete',
            'view' => 'view',
            'create' => 'create',
            'save' => 'save',
            'cancel' => 'cancel'
        ];
        
        if (isset($translations[$action])) {
            return "Action::make('" . $action . "')->label(__('filament::' . $action))\
                ";
        }
        return $matches[0];
    },
    
    // Common button text
    "/->button\('([^']+)'\)/" => function($matches) {
        $text = strtolower($matches[1]);
        $translations = [
            'save' => 'save',
            'cancel' => 'cancel',
            'submit' => 'submit',
            'update' => 'update',
            'delete' => 'delete'
        ];
        
        if (isset($translations[$text])) {
            return "->button(__('filament::' . $text))\
                ";
        }
        return $matches[0];
    },
    
    // Common text in forms
    "/->helperText\('([^']+)'\)/" => function($matches) {
        $text = strtolower($matches[1]);
        if (strpos($text, 'leave blank to generate') !== false) {
            return "->helperText(__('filament::leave_blank_to_generate'))";
        }
        return $matches[0];
    },
];

// Process each resource file
foreach ($resources as $resource) {
    $file = $resourceDir . $resource;
    if (!file_exists($file)) continue;
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Apply all patterns
    foreach ($patterns as $pattern => $replacement) {
        if (is_callable($replacement)) {
            $content = preg_replace_callback($pattern, $replacement, $content);
        } else {
            $content = preg_replace($pattern, $replacement, $content);
        }
    }
    
    // Save changes if modified
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "Updated: $resource\n";
    } else {
        echo "No changes needed: $resource\n";
    }
}

echo "\nTranslation update complete!\n";
