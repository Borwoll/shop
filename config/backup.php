<?php

return [
    'mysql' => [
        'local-storage' => [
            'disk' => 'local',
            'path' => 'backups',
        ],

        'cloud-storage' => [
            'enabled' => true,
            'disk' => 'dropbox',
            'path' => 'backups',
            'keep-local' => false,
        ],
    ],
];
