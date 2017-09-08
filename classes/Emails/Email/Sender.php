<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

/**
 * @property string|null $email The email address of the sender.
 * @property string|null $name The name of the sender.
 */
class Sender
{

    use \IvoPetkov\DataObjectTrait;
    use \IvoPetkov\DataObjectToArrayTrait;
    use \IvoPetkov\DataObjectToJSONTrait;

    function __construct()
    {
        $this->defineProperty('email', [
            'type' => '?string'
        ]);
        $this->defineProperty('name', [
            'type' => '?string'
        ]);
    }

}
