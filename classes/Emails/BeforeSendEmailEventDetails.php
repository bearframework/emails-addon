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
 * @property bool $preventDefault
 */
class BeforeSendEmailEventDetails
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
                ])
                ->defineProperty('preventDefault', [
                    'type' => 'bool',
                    'init' => function() {
                        return false;
                    }
                ])
        ;
        $this->email = $email;
    }

}
