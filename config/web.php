<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$transport = (new Swift_SmtpTransport('smtp.sendgrid.net', 587))
    ->setUsername('apikey')
    ->setPassword('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');

$config = [
    'id' => 'basic',
    'name'=> 'Alex Hawley API\'s',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'wsuw-Yy_4wW1N7d5JVZOPPV3E8eDcu2r',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            // 'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            //*/
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mailtrap.io',
                'username' => 'e607983ba45e88',
                'password' => 'cb01133657a7b8',
                'port' => '2525',
                'encryption' => 'tls',
            ]
            /*/
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.sendgrid.net',
                'username' => 'apikey',
                'password' => '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',
                'port' => '587',
            ]
            //*/
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            //'enableStrictParsing' => true,
            'showScriptName' => false,
            /*'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'last-time'],
            ],*/
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '172.68.133.110', '172.68.132.61', '172.68.143.134', '172.68.132.115',
            '172.69.22.238', '162.158.255.96', '172.68.132.229', '172.68.143.86', '172.68.189.243', '162.158.255.172',
            '172.68.142.97', '172.68.132.7', '172.69.22.88', '172.68.142.199', '172.68.132.221', '172.68.*.*',
            '172.69.*.*', '162.158.*.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '172.68.133.110', '172.68.132.61', '172.69.23.107', '172.68.132.115',
            '172.68.143.86', '172.69.22.238', '162.158.255.96', '172.68.132.229', '172.68.143.86', '172.68.189.243',
            '172.68.132.253', '162.158.255.172', '172.69.23.65', '172.68.132.7', '172.68.142.97', '172.68.132.7',
            '172.69.22.88', '172.68.142.199', '172.68.132.221', '172.68.*.*', '172.69.*.*', '162.158.*.*'],
    ];
}

return $config;
