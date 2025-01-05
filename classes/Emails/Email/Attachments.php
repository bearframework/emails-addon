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
class Attachments extends ModelsRepository
{

    /**
     * 
     */
    public function __construct()
    {
        $this->setModel(Attachment::class, 'id');
        $this->useMemoryDataDriver();
    }

    /**
     * Add a file.
     * 
     * @param string $filename The filename of the attachment.
     * @param string|null $name The file name.
     * @param string|null $mimeType The mime type of the attachment.
     */
    public function addFile(string $filename, ?string $name = null, ?string $mimeType = null): void
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
    public function addContent(string $content, ?string $name = null, ?string $mimeType = null): void
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
     * @return \BearFramework\Models\Model
     * @throws \Exception
     */
    public function makeFromArray(array $data): \BearFramework\Models\Model
    {
        if (is_array($data) && isset($data['type'])) {
            switch ($data['type']) {
                case 'file':
                    return FileAttachment::fromArray($data);
                case 'content':
                    return ContentAttachment::fromArray($data);
            }
        }
        throw new \Exception('Invalid data provided!');
    }

    /**
     * 
     * @param string $data
     * @return \BearFramework\Models\Model
     */
    public function makeFromJSON(string $data): \BearFramework\Models\Model
    {
        $decodedData = json_decode($data, true);
        if (is_array($decodedData) && isset($decodedData['type'])) {
            switch ($decodedData['type']) {
                case 'file':
                    return FileAttachment::fromJSON($data);
                case 'content':
                    return ContentAttachment::fromJSON($data);
            }
        }
        throw new \Exception('Invalid data provided!');
    }
}
