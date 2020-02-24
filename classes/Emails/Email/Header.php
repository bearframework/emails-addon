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
 * @property string|null $name The name of the custom header.
 * @property string|null $value The value of the custom header.
 */
class Header extends Model
{

    public function __construct()
    {
        $this
            ->defineProperty('name', [
                'type' => '?string'
            ])
            ->defineProperty('value', [
                'type' => '?string'
            ]);
    }
}
