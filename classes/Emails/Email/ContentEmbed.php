<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

/**
 * @property string|null $cid The cid (content ID) of the embed.
 * @property string|null $content The content of the embed.
 * @property string|null $name The name of the embed.
 * @property string|null $mimeType The mime type of the embed.
 */
class ContentEmbed
{

    use \IvoPetkov\DataObjectTrait;

    function __construct()
    {
        $this->defineProperty('cid', [
            'type' => '?string'
        ]);
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
