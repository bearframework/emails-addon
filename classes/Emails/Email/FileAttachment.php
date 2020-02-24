<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

/**
 * @property string|null $filename The filename of the attachment.
 * @property string|null $name The name of the attachment.
 * @property string|null $mimeType The mime type of the attachment.
 */
class FileAttachment extends Attachment
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
