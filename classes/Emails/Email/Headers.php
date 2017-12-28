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
class Headers
{

    /**
     *
     * @var array 
     */
    private $data = [];

    /**
     * Add a custom header.
     * 
     * @param string $name The name of the custom header.
     * @param string $value The value of the custom header.
     * @throws \InvalidArgumentException
     */
    public function add(string $name, string $value): void
    {
        $lowerCaseName = strtolower($name);
        if (in_array($lowerCaseName, ['from', 'reply-to', 'to', 'cc', 'bcc', 'date', 'subject', 'return-path', 'x-priority'])) {
            throw new \InvalidArgumentException('A header named "' . $name . '" cannot be set. Please use the corresponding property.');
        }
        $header = new \BearFramework\Emails\Email\Header();
        $header->name = $name;
        $header->value = $value;
        $this->data[] = $header;
    }

    /**
     * Removes the added custom headers.
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * Returns a list of added custom headers.
     * 
     * @return BearFramework\Emails\Email\Header[] A list of added custom headers.
     */
    public function getList()
    {
        $list = new \IvoPetkov\DataList();
        foreach ($this->data as $header) {
            $list[] = clone($header);
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
        foreach ($this->data as $header) {
            $result[] = $header->toArray();
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
