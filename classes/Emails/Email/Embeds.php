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
class Embeds
{

    /**
     *
     * @var array 
     */
    private $data = [];

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
        $embed = new \BearFramework\Emails\Email\FileEmbed();
        $embed->cid = $cid;
        $embed->filename = $filename;
        if ($name !== null) {
            $embed->name = $name;
        }
        if ($mimeType !== null) {
            $embed->mimeType = $mimeType;
        }
        $this->data[] = $embed;
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
        $embed = new \BearFramework\Emails\Email\ContentEmbed();
        $embed->cid = $cid;
        $embed->content = $content;
        if ($name !== null) {
            $embed->name = $name;
        }
        if ($mimeType !== null) {
            $embed->mimeType = $mimeType;
        }
        $this->data[] = $embed;
    }

    /**
     * Removes the added embeds.
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * Returns a list of added embeds.
     * 
     * @return array A list of added embeds.
     */
    public function getList()
    {
        $list = new \IvoPetkov\DataList();
        foreach ($this->data as $embed) {
            $list[] = clone($embed);
        }
        return $list;
    }

}
