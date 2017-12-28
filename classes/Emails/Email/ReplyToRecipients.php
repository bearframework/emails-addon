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
class ReplyToRecipients
{

    /**
     *
     * @var array 
     */
    private $data = [];

    /**
     * Add a reply to recipient.
     * 
     * @param string $email The reply to recipient email address.
     * @param string|null $name The reply to recipient name.
     */
    public function add(string $email, string $name = null): void
    {
        $replyToRecipient = new \BearFramework\Emails\Email\ReplyToRecipient();
        $replyToRecipient->email = $email;
        if ($name !== null) {
            $replyToRecipient->name = $name;
        }
        $this->data[] = $replyToRecipient;
    }

    /**
     * Removes the added reply to recipients.
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * Returns a list of added reply to recipients.
     * 
     * @return BearFramework\Emails\Email\ReplyToRecipient[] A list of added reply to recipients.
     */
    public function getList()
    {
        $list = new \IvoPetkov\DataList();
        foreach ($this->data as $replyToRecipient) {
            $list[] = clone($replyToRecipient);
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
        foreach ($this->data as $replyToRecipient) {
            $result[] = $replyToRecipient->toArray();
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
