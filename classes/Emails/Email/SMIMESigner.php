<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

/**
 * @property string $certificate
 * @property string $privateKey
 */
class SMIMESigner
{

    use \IvoPetkov\DataObjectTrait;

    function __construct()
    {
        $this->defineProperty('certificate', [
            'type' => 'string'
        ]);
        $this->defineProperty('privateKey', [
            'type' => 'string'
        ]);
    }

}
