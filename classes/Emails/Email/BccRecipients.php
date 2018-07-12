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
class BccRecipients extends ModelsRepository
{

    /**
     * 
     */
    public function __construct()
    {
        parent::__construct();
        $this->setModel(BccRecipient::class);
        $this->useMemoryDataDriver();
    }

    /**
     * Add a bcc recipient.
     * 
     * @param string $email The bcc recipient email address.
     * @param string|null $name The bcc recipient name.
     */
    public function add(string $email, string $name = null): void
    {
        $bccRecipient = $this->make();
        $bccRecipient->email = $email;
        if ($name !== null) {
            $bccRecipient->name = $name;
        }
        $this->set($bccRecipient);
    }

}
