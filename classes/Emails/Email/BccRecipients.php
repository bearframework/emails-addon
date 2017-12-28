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
class BccRecipients
{

    /**
     *
     * @var array 
     */
    private $data = [];

    /**
     * Add a bcc recipient.
     * 
     * @param string $email The bcc recipient email address.
     * @param string|null $name The bcc recipient name.
     */
    public function add(string $email, string $name = null): void
    {
        $bccRecipient = new \BearFramework\Emails\Email\BccRecipient();
        $bccRecipient->email = $email;
        if ($name !== null) {
            $bccRecipient->name = $name;
        }
        $this->data[] = $bccRecipient;
    }

    /**
     * Removes the added bcc recipients.
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * Returns a list of added bcc recipients.
     * 
     * @return BearFramework\Emails\Email\BccRecipient[] A list of added bcc recipients.
     */
    public function getList()
    {
        $list = new \IvoPetkov\DataList();
        foreach ($this->data as $bccRecipient) {
            $list[] = clone($bccRecipient);
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
        foreach ($this->data as $bccRecipient) {
            $result[] = $bccRecipient->toArray();
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
