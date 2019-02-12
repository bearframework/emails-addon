<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

use BearFramework\Models\Model;

/**
 * @property string|null $email The email address of the recipient.
 * @property string|null $name The name of the recipient.
 */
class Recipient extends Model
{

    public function __construct()
    {
        $this
                ->defineProperty('email', [
                    'type' => '?string'
                ])
                ->defineProperty('name', [
                    'type' => '?string'
        ]);
    }

}
