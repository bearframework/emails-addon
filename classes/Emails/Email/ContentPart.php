<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

/**
 * @property string|null $content The value of content part.
 * @property string|null $mimeType The mime type of the content part.
 * @property string|null $encoding The encoding of the content part.
 */
class ContentPart
{

    use \IvoPetkov\DataObjectTrait;

    function __construct()
    {
        $this->defineProperty('content', [
            'type' => '?string'
        ]);
        $this->defineProperty('mimeType', [
            'type' => '?string'
        ]);
        $this->defineProperty('encoding', [
            'type' => '?string'
        ]);
    }

}
