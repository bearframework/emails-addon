<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

/**
 * @property string|null $content The content of the attachment.
 * @property string|null $name The name of the attachment.
 * @property string|null $mimeType The mime type of the attachment.
 */
class ContentAttachment extends Attachment
{

    function __construct()
    {
        parent::__construct();
        $this
                ->defineProperty('type', [
                    'type' => 'string',
                    'get' => function() {
                        return 'content';
                    },
                    'readonly' => true
                ])
                ->defineProperty('content', [
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
