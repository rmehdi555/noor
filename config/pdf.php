<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => 'noor555',
	'subject'               => 'قرآنکده نور موعود (عج)',
	'keywords'              => 'noormouood.ir/',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('public/pdf/'),
    'font_path' => base_path('public/fonts/'),
    'font_data' => [
        'fa' => [
            'R'  => 'fonts/ttf/IRANSansWeb(FaNum).ttf',
            'B'  => 'fonts/ttf/IRANSansWeb(FaNum)_Bold.ttf',
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        'en' => [
            'R'  => 'Gothic/Century Gothic.ttf',
            'B'  => 'Gothic/GOTHICB.ttf',
        ]
    ]
];
