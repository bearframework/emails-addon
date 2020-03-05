<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

use BearFramework\App;

$app = App::get();
$context = $app->contexts->get(__DIR__);

$context->classes
        ->add('BearFramework\Emails', 'classes/Emails.php')
        ->add('BearFramework\Emails\*', 'classes/Emails/*.php');

$app->shortcuts
        ->add('emails', function() {
            return new \BearFramework\Emails();
        });
