<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

use BearFramework\Models\ModelsRepository;

/**
 */
class Content extends ModelsRepository
{

    /**
     * 
     */
    public function __construct()
    {
        $this->setModel(ContentPart::class);
        $this->useMemoryDataDriver();
    }

    /**
     * Add a content part.
     * 
     * @param string $content The value of content part.
     * @param string|null $mimeType The mime type of the content part.
     * @param string|null $encoding The encoding of the content part.
     */
    public function add(string $content, string $mimeType = null, $encoding = null): void
    {
        $contentPart = $this->make();
        $contentPart->content = $content;
        if ($mimeType !== null) {
            $contentPart->mimeType = $mimeType;
        }
        if ($encoding !== null) {
            $contentPart->encoding = $encoding;
        }
        $this->set($contentPart);
    }

}
