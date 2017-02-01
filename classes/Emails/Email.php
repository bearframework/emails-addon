<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails;

/**
 * @property-read \BearFramework\Emails\Email\Sender $sender
 * @property-read \BearFramework\Emails\Email\ReplyTo $replyTo
 * @property-read \BearFramework\Emails\Email\Recipients $recipients
 * @property string|null $subject
 * @property-read \BearFramework\Emails\Email\Content $content
 * @property string|null $returnPath
 * @property int|null $priority
 * @property-read \BearFramework\Emails\Email\Attachments $attachments
 * @property-read \BearFramework\Emails\Email\Embeds $embeds
 * @property-read \BearFramework\Emails\Email\Signers $signers
 */
class Email
{

    use \IvoPetkov\DataObjectTrait;

    function __construct()
    {
        $this->defineProperty('sender', [
            'init' => function() {
                return new \BearFramework\Emails\Email\Sender();
            },
            'readonly' => true
        ]);
        $this->defineProperty('replyTo', [
            'init' => function() {
                return new \BearFramework\Emails\Email\ReplyTo();
            },
            'readonly' => true
        ]);
        $this->defineProperty('recipients', [
            'init' => function() {
                return new \BearFramework\Emails\Email\Recipients();
            },
            'readonly' => true
        ]);
        $this->defineProperty('subject', [
            'type' => '?string'
        ]);
        $this->defineProperty('content', [
            'init' => function() {
                return new \BearFramework\Emails\Email\Content();
            },
            'readonly' => true
        ]);
        $this->defineProperty('returnPath', [
            'type' => '?string'
        ]);
        $this->defineProperty('priority', [
            'type' => '?int'
        ]);
        $this->defineProperty('attachments', [
            'init' => function() {
                return new \BearFramework\Emails\Email\Attachments();
            },
            'readonly' => true
        ]);
        $this->defineProperty('embeds', [
            'init' => function() {
                return new \BearFramework\Emails\Email\Embeds();
            },
            'readonly' => true
        ]);
        $this->defineProperty('signers', [
            'init' => function() {
                return new \BearFramework\Emails\Email\Signers();
            },
            'readonly' => true
        ]);
    }

}
