<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

use BearFramework\Models\Model;

/**
 * @property string|null $content The value of content part.
 * @property string|null $mimeType The mime type of the content part.
 * @property string|null $encoding The encoding of the content part.
 */
class ContentPart extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this
                ->defineProperty('content', [
                    'type' => '?string'
                ])
                ->defineProperty('mimeType', [
                    'type' => '?string'
                ])
                ->defineProperty('encoding', [
                    'type' => '?string'
        ]);
    }

}
