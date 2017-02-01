<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

/**
 */
class Content
{

    /**
     *
     * @var array 
     */
    private $data = [];

    /**
     * Add a content part.
     * 
     * @param string $content The value of content part.
     * @param string|null $mimeType The mime type of the content part.
     * @param string|null $encoding The encoding of the content part.
     */
    public function add(string $content, string $mimeType = null, $encoding = null): void
    {
        $contentPart = new \BearFramework\Emails\Email\ContentPart();
        $contentPart->content = $content;
        if ($mimeType !== null) {
            $contentPart->mimeType = $mimeType;
        }
        if ($encoding !== null) {
            $contentPart->encoding = $encoding;
        }
        $this->data[] = $contentPart;
    }

    /**
     * Removes the added content parts.
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * Returns a list of added content parts.
     * 
     * @return BearFramework\Emails\Email\ContentPart[] A list of added content parts.
     */
    public function getList()
    {
        $list = new \IvoPetkov\DataList();
        foreach ($this->data as $contentPart) {
            $list[] = clone($contentPart);
        }
        return $list;
    }

}
