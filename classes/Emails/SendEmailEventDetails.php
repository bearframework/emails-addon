<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails;

/**
 * @property \BearFramework\Emails\Email $email
 */
class SendEmailEventDetails
{

    use \IvoPetkov\DataObjectTrait;

    /**
     * 
     * @param \BearFramework\Emails\Email $email
     */
    public function __construct(\BearFramework\Emails\Email $email)
    {
        $this
            ->defineProperty('email', [
                'type' => \BearFramework\Emails\Email::class
            ]);
        $this->email = $email;
    }
}
