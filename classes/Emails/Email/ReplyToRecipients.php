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
class ReplyToRecipients extends ModelsRepository
{

    /**
     * 
     */
    public function __construct()
    {
        $this->setModel(ReplyToRecipient::class);
        $this->useMemoryDataDriver();
    }

    /**
     * Add a reply to recipient.
     * 
     * @param string $email The reply to recipient email address.
     * @param string|null $name The reply to recipient name.
     */
    public function add(string $email, string $name = null): void
    {
        $replyToRecipient = $this->make();
        $replyToRecipient->email = $email;
        if ($name !== null) {
            $replyToRecipient->name = $name;
        }
        $this->set($replyToRecipient);
    }

}
