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
class CcRecipients
{

    /**
     *
     * @var array 
     */
    private $data = [];

    /**
     * Add a cc recipient.
     * 
     * @param string $email The cc recipient email address.
     * @param string|null $name The cc recipient name.
     */
    public function add(string $email, string $name = null): void
    {
        $ccRecipient = new \BearFramework\Emails\Email\CcRecipient();
        $ccRecipient->email = $email;
        if ($name !== null) {
            $ccRecipient->name = $name;
        }
        $this->data[] = $ccRecipient;
    }

    /**
     * Removes the added cc recipients.
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * Returns a list of added cc recipients.
     * 
     * @return BearFramework\Emails\Email\CcRecipient[] A list of added cc recipients.
     */
    public function getList()
    {
        $list = new \IvoPetkov\DataList();
        foreach ($this->data as $ccRecipient) {
            $list[] = clone($ccRecipient);
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
        foreach ($this->data as $ccRecipient) {
            $result[] = $ccRecipient->toArray();
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
