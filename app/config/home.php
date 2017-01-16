<?php
return array(
    'app' => array(
        'url'  => 'http://localhost',
        'hash' => array(
            'algo' => PASSWORD_BCRYPT,
            'cost' => 10
        )
    ),

    'db' => array(
        'driver'    => 'mysql',
        'host'      => '127.0.0.1',
        'name'      => 'application',
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => ''
    )
);