<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Hooks;

/**
 * @property ?\BearFramework\Emails\Email $email The message that will be send.
 * @property bool $canceled TRUE if you want to cancel the email.
 * @property ?string $canceledReason The reason for the cancellation.
 */
class EmailSend
{

    use \IvoPetkov\DataObjectTrait;

    function __construct()
    {
        $this->defineProperty('email', [
            'type' => '?\BearFramework\Emails\Email'
        ]);
        $this->defineProperty('canceled', [
            'type' => 'bool',
            'init' => function() {
                return false;
            }
        ]);
        $this->defineProperty('canceledReason', [
            'type' => '?string',
        ]);
    }

}
