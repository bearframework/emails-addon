<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

/**
 * @property string|null $cid The cid (content ID) of the embed.
 * @property string|null $filename The filename of the embed.
 * @property string|null $name The name of the embed.
 * @property string|null $mimeType The mime type of the embed.
 */
class FileEmbed extends Embed
{

    public function __construct()
    {
        parent::__construct();
        $this
            ->defineProperty('type', [
                'type' => 'string',
                'get' => function () {
                    return 'file';
                },
                'readonly' => true
            ])
            ->defineProperty('cid', [
                'type' => '?string'
            ])
            ->defineProperty('filename', [
                'type' => '?string'
            ])
            ->defineProperty('name', [
                'type' => '?string'
            ])
            ->defineProperty('mimeType', [
                'type' => '?string'
            ]);
    }
}
