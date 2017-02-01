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
class ContentAttachment
{

    use \IvoPetkov\DataObjectTrait;

    function __construct()
    {
        $this->defineProperty('content', [
            'type' => '?string'
        ]);
        $this->defineProperty('name', [
            'type' => '?string'
        ]);
        $this->defineProperty('mimeType', [
            'type' => '?string'
        ]);
    }

}
