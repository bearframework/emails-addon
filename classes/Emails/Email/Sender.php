<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

use BearFramework\Models\Model;

/**
 * @property string|null $email The email address of the sender.
 * @property string|null $name The name of the sender.
 */
class Sender extends Model
{

    function __construct()
    {
        parent::__construct();
        $this
                ->defineProperty('email', [
                    'type' => '?string'
                ])
                ->defineProperty('name', [
                    'type' => '?string'
        ]);
    }

}
