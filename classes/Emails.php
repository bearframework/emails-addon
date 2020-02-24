<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework;

use BearFramework\App;

/**
 * Emails utilities.
 */
class Emails
{

    use \BearFramework\EventsTrait;

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
    public function make(): \BearFramework\Emails\Email
    {
        if (self::$newEmailCache === null) {
            self::$newEmailCache = new \BearFramework\Emails\Email();
        }
        return clone (self::$newEmailCache);
    }

    /**
     * Constructs a new email and returns it.
     * 
     * @return \BearFramework\Emails\Email
     */
    public function makeFromArray(array $data): \BearFramework\Emails\Email
    {
        return \BearFramework\Emails\Email::fromArray($data);
    }

    /**
     * Constructs a new email and returns it.
     * 
     * @return \BearFramework\Emails\Email
     */
    public function makeFromJSON(string $data): \BearFramework\Emails\Email
    {
        return \BearFramework\Emails\Email::fromJSON($data);
    }

    /**
     * Sends a email.
     * 
     * @param \BearFramework\Emails\Email $email The email to send.
     * @return void No value is returned.
     * @throws \Exception
     */
    public function send(\BearFramework\Emails\Email $email): void
    {
        $app = App::get();
        $email = clone ($email);

        if ($this->hasEventListeners('beforeSendEmail')) {
            $eventDetails = new \BearFramework\Emails\BeforeSendEmailEventDetails($email);
            $this->dispatchEvent('beforeSendEmail', $eventDetails);
            if ($eventDetails->preventDefault) {
                return;
            }
        }

        if (empty($this->senders)) {
            throw new \Exception('No email senders added.');
        }

        foreach ($this->senders as $sender) {
            if (is_callable($sender)) {
                $sender = call_user_func($sender);
            }
            if (is_string($sender)) {
                $sender = new $sender();
            }
            if ($sender instanceof \BearFramework\Emails\ISender) {
                if ($sender->send($email)) {
                    if ($this->hasEventListeners('sendEmail')) {
                        $eventDetails = new \BearFramework\Emails\SendEmailEventDetails($email);
                        $this->dispatchEvent('sendEmail', $eventDetails);
                    }
                    return;
                }
            }
        }
        throw new \Exception('No email sender is capable of sending the email provided.');
    }

    /**
     * Registers a email sender.
     * 
     * @param string $sender A class name, an object or a callback that returns a class name or and object.
     * @return void No value is returned.
     */
    public function registerSender($sender): void
    {
        $this->senders[] = $sender;
    }
}
