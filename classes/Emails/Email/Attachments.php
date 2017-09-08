<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

use BearFramework\Emails\Email\FileAttachment;
use BearFramework\Emails\Email\ContentAttachment;

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
        $attachment = new FileAttachment();
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
        $attachment = new ContentAttachment();
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

    /**
     * Returns the object data converted as an array
     * 
     * @return array The object data converted as an array
     */
    public function toArray()
    {
        $result = [];
        foreach ($this->data as $attachment) {
            $attachmentData = $attachment->toArray();
            $type = 'unknown';
            if ($attachment instanceof FileAttachment) {
                $type = 'file';
            } elseif ($attachment instanceof ContentAttachment) {
                $type = 'content';
            }
            $attachmentData = array_merge(['type' => $type], $attachmentData);
            $result[] = $attachmentData;
        }
        return $result;
    }

    /**
     * Returns the object data converted as JSON
     * 
     * @return string The object data converted as JSON
     */
    public function toJSON()
    {
        return json_encode($this->toArray());
    }

}
