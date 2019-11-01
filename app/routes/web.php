<?php

/**
* web router
*/
$app->get(
     '/',
    function () {
        echo 'Home';
    }
);

$app->get(
    '/error',
    function () {
        echo 'error';
    }
);

$app->get(
    '/user',
    function () {
        $users = \App\Models\Users::find();
        foreach ($users as $user) {
            echo $user->name, '<br>';
        }
    }
);