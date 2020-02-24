<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

use BearFramework\Models\ModelsRepository;

/**
 */
class CcRecipients extends ModelsRepository
{

    /**
     * 
     */
    public function __construct()
    {
        $this->setModel(CcRecipient::class, 'email');
        $this->useMemoryDataDriver();
    }

    /**
     * Add a cc recipient.
     * 
     * @param string $email The cc recipient email address.
     * @param string|null $name The cc recipient name.
     */
    public function add(string $email, string $name = null): void
    {
        $ccRecipient = $this->make();
        $ccRecipient->email = $email;
        if ($name !== null) {
            $ccRecipient->name = $name;
        }
        $this->set($ccRecipient);
    }
}
