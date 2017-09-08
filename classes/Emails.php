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
        $app = App::get();
        $email = clone($email);

        $getEmailAsText = function($email) {
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
            return $emailAsText;
        };

        if ($app->hooks->exists('emailSend')) {
            $preventDefault = false;
            $app->hooks->execute('emailSend', $email, $preventDefault);
            if ($preventDefault) {
                $app->logger->log('email', 'Default email sender cancelled.' . "\n" . $getEmailAsText($email));
                return;
            }
        }

        if (empty($this->senders)) {
            throw new \Exception('No email senders added.');
        }

        foreach ($this->senders as $class) {
            $sender = new $class();
            if ($sender instanceof \BearFramework\Emails\ISender) {
                if ($sender->send($email)) {
                    $app->logger->log('email', 'Email sent.' . "\n" . $getEmailAsText($email));
                    $app->hooks->execute('emailSent', $email);
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
