<?php

use Illuminate\Database\Capsule\Manager AS Capsule;

$Config = $container['Config'];

$capsule = New Capsule();


$capsule->addConnection($Config->get('db'));

$capsule->setAsGlobal();

$capsule->bootEloquent();

