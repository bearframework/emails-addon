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
class DKIMSigner extends Signer
{

    public function __construct()
    {
        parent::__construct();
        $this
                ->defineProperty('type', [
                    'type' => 'string',
                    'get' => function() {
                        return 'DKIM';
                    },
                    'readonly' => true
                ])
                ->defineProperty('privateKey', [
                    'type' => 'string'
                ])
                ->defineProperty('domain', [
                    'type' => 'string'
                ])
                ->defineProperty('selector', [
                    'type' => 'string'
        ]);
    }

}
