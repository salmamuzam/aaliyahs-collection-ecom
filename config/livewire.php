<?php

return [
    'temporary_file_upload' => [
        'disk' => 'public',        // Use public disk (storage/app/public) which we know works
        'rules' => 'file|max:12288', // 12MB
        'directory' => 'livewire-tmp',
        'middleware' => null, // throttle:60,1
        'preview_mimes' => [   // Supported file types for temporary previews...
            'png',
            'gif',
            'bmp',
            'svg',
            'wav',
            'mp4',
            'mov',
            'avi',
            'wmv',
            'mp3',
            'm4a',
            'jpg',
            'jpeg',
            'mpga',
            'webp',
            'wma',
        ],
        'max_upload_time' => 5, // 5 minutes
    ],
    'layout' => 'components.layouts.app',
    'inject_assets' => true,
    'navigate' => [
        'show_progress_bar' => true,
    ],
];
