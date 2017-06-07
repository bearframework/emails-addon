<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework;

use BearFramework\App;

/**
 * Emails utilities.
 */
class Emails
{

    /**
     *
     */
    private static $newEmailCache = null;

    /**
     *
     * @var array 
     */
    private $senders = [];

    /**
     * Constructs a new email and returns it.
     * 
     * @return \BearFramework\Emails\Email
     */
    function make(): \BearFramework\Emails\Email
    {
        if (self::$newEmailCache === null) {
            self::$newEmailCache = new \BearFramework\Emails\Email();
        }
        return clone(self::$newEmailCache);
    }

    /**
     * Sends a email.
     * 
     * @param \BearFramework\Emails\Email $email The email to send.
     * @return void No value is returned.
     * @throws \Exception
     */
    function send(\BearFramework\Emails\Email $email): void
    {
        if (empty($this->senders)) {
            throw new \Exception('No email senders added.');
        }

        $emailAsText = 'Sender: ' . $email->sender->email . (strlen($email->sender->name) > 0 ? ' (' . $email->sender->name . ')' : '') . "\n";
        $recipients = $email->recipients->getList();
        foreach ($recipients as $recipient) {
            $emailAsText .= 'Recipient: ' . $recipient->email . (strlen($recipient->name) > 0 ? ' (' . $recipient->name . ')' : '') . "\n";
        }
        $emailAsText .= 'Subject: ' . $email->subject . "\n";
        $contentParts = $email->content->getList();
        foreach ($contentParts as $contentPart) {
            $emailAsText .= 'Content (' . $contentPart->mimeType . '):' . "\n" . $contentPart->content . "\n";
        }

        $app = App::get();
        if ($app->hooks->exists('emailSend')) {
            $data = new \BearFramework\Emails\Hooks\EmailSend();
            $data->email = $email;
            $app->hooks->execute('emailSend', $data);
            if ($data->canceled) {
                $app->logger->log('email', 'Email canceled.' . "\n" . $emailAsText);
                return;
            }
        }
        foreach ($this->senders as $class) {
            $sender = new $class();
            if ($sender instanceof \BearFramework\Emails\ISender) {
                if ($sender->send($email)) {
                    if ($app->hooks->exists('emailSent')) {
                        $data = new \BearFramework\Emails\Hooks\EmailSent();
                        $data->email = $email;
                        $app->hooks->execute('emailSent', $data);
                    }
                    $app->logger->log('email', 'Email sent.' . "\n" . $emailAsText);
                    return;
                }
            }
        }
        throw new \Exception('No email sender is capable of sending the email provided.');
    }

    /**
     * Registers a email sender.
     * 
     * @param string $class The class name of the email sender to register.
     * @return void No value is returned.
     */
    function registerSender(string $class): void
    {
        $this->senders[] = $class;
    }

}
