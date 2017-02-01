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
class Attachments
{

    /**
     *
     * @var array 
     */
    private $data = [];

    /**
     * Add a file.
     * 
     * @param string $filename The filename of the attachment.
     * @param string|null $name The file name.
     * @param string|null $mimeType The mime type of the attachment.
     */
    public function addFile(string $filename, string $name = null, string $mimeType = null): void
    {
        $attachment = new \BearFramework\Emails\Email\FileAttachment();
        $attachment->filename = $filename;
        if ($name !== null) {
            $attachment->name = $name;
        }
        if ($mimeType !== null) {
            $attachment->mimeType = $mimeType;
        }
        $this->data[] = $attachment;
    }
    
    /**
     * Add a content.
     * 
     * @param string $content The content of the attachment.
     * @param string|null $name The file name.
     * @param string|null $mimeType The mime type of the attachment.
     */
    public function addContent(string $content, string $name = null, string $mimeType = null): void
    {
        $attachment = new \BearFramework\Emails\Email\ContentAttachment();
        $attachment->content = $content;
        if ($name !== null) {
            $attachment->name = $name;
        }
        if ($mimeType !== null) {
            $attachment->mimeType = $mimeType;
        }
        $this->data[] = $attachment;
    }

    /**
     * Removes the added attachments.
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * Returns a list of added attachments.
     * 
     * @return array A list of added attachments.
     */
    public function getList()
    {
        $list = new \IvoPetkov\DataList();
        foreach ($this->data as $attachment) {
            $list[] = clone($attachment);
        }
        return $list;
    }

}
