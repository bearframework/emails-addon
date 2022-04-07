<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

/**
 * @property string $certificate
 * @property string $privateKey
 */
class SMIMESigner extends Signer
{

    public function __construct()
    {
        parent::__construct();
        $this
            ->defineProperty('type', [
                'type' => 'string',
                'get' => function () {
                    return 'SMIME';
                },
                //'readonly' => true // Fix for models-addon v1.4
            ])
            ->defineProperty('certificate', [
                'type' => 'string'
            ])
            ->defineProperty('privateKey', [
                'type' => 'string'
            ]);
    }
}
