<?php

return [
    'mysql' => [
        'mysql_path' => 'mysql',
        'mysqldump_path' => 'mysqldump',
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
