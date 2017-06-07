<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Hooks;

/**
 * @property ?\BearFramework\Emails\Email $email The message that has been sent
 */
class EmailSent
{

    use \IvoPetkov\DataObjectTrait;

    function __construct()
    {
        $this->defineProperty('email', [
            'type' => '?\BearFramework\Emails\Email'
        ]);
    }

}
