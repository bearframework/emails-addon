<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

/**
 */
class Details
{
    /**
     * 
     * @var array
     */
    private $data = [];

    /**
     * 
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * 
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function set(string $name, $value): void
    {
        $this->data[$name] = $value;
    }

    /**
     * 
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }

    /**
     * 
     * @return array
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * 
     * @return string
     */
    public function toJSON(): string
    {
        return json_encode($this->data);
    }

    /**
     * 
     * @param array $data
     * @return \BearFramework\Emails\Email\Details
     */
    static public function fromArray(array $data): \BearFramework\Emails\Email\Details
    {
        $details = new \BearFramework\Emails\Email\Details();
        $details->__fromArray($data);
        return $details;
    }

    /**
     * 
     * @param string $data
     * @return \BearFramework\Emails\Email\Details
     */
    static public function fromJSON(string $data): \BearFramework\Emails\Email\Details
    {
        $details = new \BearFramework\Emails\Email\Details();
        $details->__fromJSON($data);
        return $details;
    }

    /**
     * 
     * @param array $data
     * @return void
     */
    public function __fromArray(array $data): void
    {
        $this->data = $data;
    }

    /**
     * 
     * @param string $data
     * @return void
     */
    public function __fromJSON(string $data): void
    {
        $this->data = json_decode($data, true);
    }
}
