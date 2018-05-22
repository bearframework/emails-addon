<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

use BearFramework\Models\ModelsRepository;

/**
 */
class Attachments extends ModelsRepository
{

    /**
     * 
     */
    public function __construct()
    {
        $this->setModel(Attachment::class);
        $this->useMemoryDataDriver();
    }

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
        $this->set($attachment);
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
        $this->set($attachment);
    }

    /**
     * 
     * @param array $data
     */
    public function __fromArray(array $data): void
    {
        foreach ($data as $item) {
            if (is_array($item) && isset($item['type'])) {
                switch ($item['type']) {
                    case 'content':
                        $this->set(ContentAttachment::fromArray($item));
                        break;
                    case 'file':
                        $this->set(FileAttachment::fromArray($item));
                        break;
                    default :
                        $this->set(Attachment::fromArray($item));
                        break;
                }
            }
        }
    }

    /**
     * 
     * @param string $data
     */
    public function __fromJSON(string $data): void
    {
        $this->__fromArray(json_decode($data, true));
    }

}
