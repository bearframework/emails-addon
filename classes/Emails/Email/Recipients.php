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
class Recipients
{

    /**
     *
     * @var array 
     */
    private $data = [];

    /**
     * Add a recipient.
     * 
     * @param string $email The recipient email address.
     * @param string|null $name The recipient name.
     */
    public function add(string $email, string $name = null): void
    {
        $recipient = new \BearFramework\Emails\Email\Recipient();
        $recipient->email = $email;
        if ($name !== null) {
            $recipient->name = $name;
        }
        $this->data[] = $recipient;
    }

    /**
     * Removes the added recipients.
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * Returns a list of added recipients.
     * 
     * @return BearFramework\Emails\Email\Recipient[] A list of added recipients.
     */
    public function getList()
    {
        $list = new \IvoPetkov\DataList();
        foreach ($this->data as $recipient) {
            $list[] = clone($recipient);
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
        foreach ($this->data as $recipient) {
            $result[] = $recipient->toArray();
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
