<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails;

use BearFramework\Models\Model;

/**
 * @property-read \BearFramework\Emails\Email\Sender $sender
 * @property-read \BearFramework\Emails\Email\ReplyToRecipients $replyToRecipients
 * @property-read \BearFramework\Emails\Email\Recipients $recipients
 * @property-read \BearFramework\Emails\Email\CcRecipients $ccRecipients
 * @property-read \BearFramework\Emails\Email\BccRecipients $bccRecipients
 * @property int|null $date
 * @property string|null $subject
 * @property-read \BearFramework\Emails\Email\Content $content
 * @property string|null $returnPath
 * @property int|null $priority
 * @property-read \BearFramework\Emails\Email\Attachments $attachments
 * @property-read \BearFramework\Emails\Email\Embeds $embeds
 * @property-read \BearFramework\Emails\Email\Signers $signers
 * @property-read \BearFramework\Emails\Email\Headers $headers
 * @property-read \BearFramework\Emails\Email\Details $details
 */
class Email extends Model
{

    public function __construct()
    {
        $this
            ->defineProperty('sender', [
                'init' => function () {
                    return new \BearFramework\Emails\Email\Sender();
                },
                'readonly' => true
            ])
            ->defineProperty('replyToRecipients', [
                'init' => function () {
                    return new \BearFramework\Emails\Email\ReplyToRecipients();
                },
                'readonly' => true
            ])
            ->defineProperty('recipients', [
                'type' => \BearFramework\Emails\Email\Recipients::class,
                'readonly' => true
            ])
            ->defineProperty('ccRecipients', [
                'init' => function () {
                    return new \BearFramework\Emails\Email\CcRecipients();
                },
                'readonly' => true
            ])
            ->defineProperty('bccRecipients', [
                'init' => function () {
                    return new \BearFramework\Emails\Email\BccRecipients();
                },
                'readonly' => true
            ])
            ->defineProperty('subject', [
                'type' => '?string'
            ])
            ->defineProperty('date', [
                'type' => '?int'
            ])
            ->defineProperty('content', [
                'init' => function () {
                    return new \BearFramework\Emails\Email\Content();
                },
                'readonly' => true
            ])
            ->defineProperty('returnPath', [
                'type' => '?string'
            ])
            ->defineProperty('priority', [
                'type' => '?int'
            ])
            ->defineProperty('attachments', [
                'init' => function () {
                    return new \BearFramework\Emails\Email\Attachments();
                },
                'readonly' => true
            ])
            ->defineProperty('embeds', [
                'init' => function () {
                    return new \BearFramework\Emails\Email\Embeds();
                },
                'readonly' => true
            ])
            ->defineProperty('signers', [
                'init' => function () {
                    return new \BearFramework\Emails\Email\Signers();
                },
                'readonly' => true
            ])
            ->defineProperty('headers', [
                'init' => function () {
                    return new \BearFramework\Emails\Email\Headers();
                },
                'readonly' => true
            ])
            ->defineProperty('details', [
                'init' => function () {
                    return new \BearFramework\Emails\Email\Details();
                },
                'readonly' => true
            ]);
    }
}
