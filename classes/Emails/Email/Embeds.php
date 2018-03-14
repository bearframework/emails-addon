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
class Embeds extends ModelsRepository
{

    /**
     * 
     */
    public function __construct()
    {
        $this->setModel(Embed::class);
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
     */
    public function __fromArray(array $data): void
    {
        foreach ($data as $item) {
            if (is_array($item) && isset($item['type'])) {
                switch ($item['type']) {
                    case 'content':
                        $this->set(ContentEmbed::fromArray($item));
                        break;
                    case 'file':
                        $this->set(FileEmbed::fromArray($item));
                        break;
                    default :
                        $this->set(Embed::fromArray($item));
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
