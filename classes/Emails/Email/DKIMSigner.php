<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

/**
 * @property string $privateKey
 * @property string $domain
 * @property string $selector
 */
class DKIMSigner
{

    use \IvoPetkov\DataObjectTrait;

    function __construct()
    {
        $this->defineProperty('privateKey', [
            'type' => 'string'
        ]);
        $this->defineProperty('domain', [
            'type' => 'string'
        ]);
        $this->defineProperty('selector', [
            'type' => 'string'
        ]);
    }

}
