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
class Recipients extends ModelsRepository
{

    /**
     * 
     */
    public function __construct()
    {
        $this->setModel(Recipient::class);
        $this->useMemoryDataDriver();
    }

    /**
     * Add a recipient.
     * 
     * @param string $email The recipient email address.
     * @param string|null $name The recipient name.
     */
    public function add(string $email, string $name = null): void
    {
        $recipient = $this->make();
        $recipient->email = $email;
        if ($name !== null) {
            $recipient->name = $name;
        }
        $this->set($recipient);
    }

}
