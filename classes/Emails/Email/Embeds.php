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
class Embeds extends ModelsRepository
{

    /**
     * 
     */
    public function __construct()
    {
        $this->setModel(Embed::class, 'id');
        $this->useMemoryDataDriver();
    }

    /**
     * Add a file.
     * 
     * @param string $cid The cid (content ID) of the embed.
     * @param string $filename The filename of the embed.
     * @param string|null $name The name of the embed.
     * @param string|null $mimeType The mime type of the embed.
     */
    public function addFile(string $cid, string $filename, string $name = null, string $mimeType = null): void
    {
        $embed = new FileEmbed();
        $embed->cid = $cid;
        $embed->filename = $filename;
        if ($name !== null) {
            $embed->name = $name;
        }
        if ($mimeType !== null) {
            $embed->mimeType = $mimeType;
        }
        $this->set($embed);
    }

    /**
     * Add a content.
     * 
     * @param string $cid The cid (content ID) of the embed.
     * @param string $content The content of the embed.
     * @param string|null $name The name of the embed.
     * @param string|null $mimeType The mime type of the embed.
     */
    public function addContent(string $cid, string $content, string $name = null, string $mimeType = null): void
    {
        $embed = new ContentEmbed();
        $embed->cid = $cid;
        $embed->content = $content;
        if ($name !== null) {
            $embed->name = $name;
        }
        if ($mimeType !== null) {
            $embed->mimeType = $mimeType;
        }
        $this->set($embed);
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
                    return FileEmbed::fromArray($data);
                case 'content':
                    return ContentEmbed::fromArray($data);
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
                    return FileEmbed::fromJSON($data);
                case 'content':
                    return ContentEmbed::fromJSON($data);
            }
        }
        throw new \Exception('Invalid data provided!');
    }
}
