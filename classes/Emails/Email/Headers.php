<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

use BearFramework\Models\ModelsRepository;
use BearFramework\Emails\Email\Header;

/**
 */
class Headers extends ModelsRepository
{

    /**
     * 
     */
    public function __construct()
    {
        $this->setModel(Header::class, 'name');
        $this->useMemoryDataDriver();
    }

    /**
     * Add a custom header.
     * 
     * @param string $name The name of the custom header.
     * @param string $value The value of the custom header.
     * @throws \InvalidArgumentException
     */
    public function add(string $name, string $value): void
    {
        $header = $this->make();
        $header->name = $name;
        $header->value = $value;
        $this->set($header);
    }

    /**
     * 
     * @param \BearFramework\Emails\Email\Header $model
     * @throws \InvalidArgumentException
     */
    public function set($model): void
    {
        $lowerCaseName = strtolower($model->name);
        if (in_array($lowerCaseName, ['from', 'reply-to', 'to', 'cc', 'bcc', 'date', 'subject', 'return-path', 'x-priority'])) {
            throw new \InvalidArgumentException('A header named "' . $model->name . '" cannot be set. Please use the corresponding property.');
        }
        parent::set($model);
    }

}
