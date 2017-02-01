<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

/**
 * @property string|null $filename The filename of the attachment.
 * @property string|null $name The name of the attachment.
 * @property string|null $mimeType The mime type of the attachment.
 */
class FileAttachment
{

    use \IvoPetkov\DataObjectTrait;

    function __construct()
    {
        $this->defineProperty('filename', [
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
