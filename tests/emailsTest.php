<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

class DummyEmailSender implements \BearFramework\Emails\ISender
{

    public function send(\BearFramework\Emails\Email $email): bool
    {
        return true;
    }

}

class DummyFaultyEmailSender implements \BearFramework\Emails\ISender
{

    public function send(\BearFramework\Emails\Email $email): bool
    {
        return false;
    }

}

/**
 * @runTestsInSeparateProcesses
 */
class EmailsTest extends BearFrameworkAddonTestCase
{

    /**
     * 
     */
    public function testConstruct()
    {

        $checkIsEmpty = function($email) {
            $this->assertEquals($email->subject, null);
            $this->assertEquals($email->sender->email, null);
            $this->assertEquals($email->sender->name, null);
            $this->assertEquals($email->replyTo->email, null);
            $this->assertEquals($email->replyTo->name, null);
            $this->assertEquals($email->returnPath, null);
            $this->assertEquals($email->priority, null);
            $recipients = $email->recipients->getList();
            $this->assertEquals($recipients->length, 0);
            $contentParts = $email->content->getList();
            $this->assertEquals($contentParts->length, 0);
            $attachments = $email->attachments->getList();
            $this->assertEquals($attachments->length, 0);
            $embeds = $email->embeds->getList();
            $this->assertEquals($embeds->length, 0);
            $signers = $email->signers->getList();
            $this->assertEquals($signers->length, 0);
        };

        $app = $this->getApp();
        $email = $app->emails->make();

        $checkIsEmpty($email);

        $email->subject = 'The subject';
        $email->sender->email = 'sender@example.com';
        $email->sender->name = 'John Smith';
        $email->replyTo->email = 'replyto@example.com';
        $email->replyTo->name = 'John';
        $email->returnPath = 'bounce@example.com';
        $email->priority = 3;
        $email->recipients->add('recipient1@example.com', 'Mark Smith');
        $email->recipients->add('recipient2@example.com', 'Bill Smith');
        $email->content->add('<strong>Hi</strong>', 'text/html', 'utf-8');
        $email->content->add('Hi', 'text/plain');
        $email->attachments->addFile('/path/to/file1.jpg', 'file1.jpg', 'image/jpeg');
        $email->attachments->addContent('text1', 'text1.txt', 'text/plain');
        $email->embeds->addFile('embed1', '/path/to/file2.jpg', 'file2.jpg', 'image/jpeg');
        $email->embeds->addContent('embed2', 'text2', 'text2.txt', 'text/plain');
        $email->signers->addSMIME('content of certificate.pem', 'content of private-key.pem');
        $email->signers->addDKIM('content of private-key.pem', 'example.com', 'default');

        $this->assertEquals($email->subject, 'The subject');
        $this->assertEquals($email->sender->email, 'sender@example.com');
        $this->assertEquals($email->sender->name, 'John Smith');
        $this->assertEquals($email->replyTo->email, 'replyto@example.com');
        $this->assertEquals($email->replyTo->name, 'John');
        $this->assertEquals($email->returnPath, 'bounce@example.com');
        $this->assertEquals($email->priority, 3);
        $recipients = $email->recipients->getList();
        $this->assertEquals($recipients[0]->email, 'recipient1@example.com');
        $this->assertEquals($recipients[0]->name, 'Mark Smith');
        $this->assertEquals($recipients[1]->email, 'recipient2@example.com');
        $this->assertEquals($recipients[1]->name, 'Bill Smith');
        $contentParts = $email->content->getList();
        $this->assertEquals($contentParts[0]->content, '<strong>Hi</strong>');
        $this->assertEquals($contentParts[0]->mimeType, 'text/html');
        $this->assertEquals($contentParts[0]->encoding, 'utf-8');
        $this->assertEquals($contentParts[1]->content, 'Hi');
        $this->assertEquals($contentParts[1]->mimeType, 'text/plain');
        $this->assertEquals($contentParts[1]->encoding, null);
        $attachments = $email->attachments->getList();
        $this->assertEquals($attachments[0]->filename, '/path/to/file1.jpg');
        $this->assertEquals($attachments[0]->name, 'file1.jpg');
        $this->assertEquals($attachments[0]->mimeType, 'image/jpeg');
        $this->assertEquals($attachments[1]->content, 'text1');
        $this->assertEquals($attachments[1]->name, 'text1.txt');
        $this->assertEquals($attachments[1]->mimeType, 'text/plain');
        $embeds = $email->embeds->getList();
        $this->assertEquals($embeds[0]->cid, 'embed1');
        $this->assertEquals($embeds[0]->filename, '/path/to/file2.jpg');
        $this->assertEquals($embeds[0]->name, 'file2.jpg');
        $this->assertEquals($embeds[0]->mimeType, 'image/jpeg');
        $this->assertEquals($embeds[1]->cid, 'embed2');
        $this->assertEquals($embeds[1]->content, 'text2');
        $this->assertEquals($embeds[1]->name, 'text2.txt');
        $this->assertEquals($embeds[1]->mimeType, 'text/plain');
        $signers = $email->signers->getList();
        $this->assertEquals($signers[0]->certificate, 'content of certificate.pem');
        $this->assertEquals($signers[0]->privateKey, 'content of private-key.pem');
        $this->assertEquals($signers[1]->privateKey, 'content of private-key.pem');
        $this->assertEquals($signers[1]->domain, 'example.com');
        $this->assertEquals($signers[1]->selector, 'default');

        $email->subject = null;
        $email->sender->email = null;
        $email->sender->name = null;
        $email->replyTo->email = null;
        $email->replyTo->name = null;
        $email->returnPath = null;
        $email->priority = null;
        $email->recipients->clear();
        $email->content->clear();
        $email->attachments->clear();
        $email->embeds->clear();
        $email->signers->clear();

        $checkIsEmpty($email);
    }

    /**
     * 
     */
    public function testSend()
    {
        $app = $this->getApp();
        $app->emails->registerSender('DummyEmailSender');
        $email = $app->emails->make();
        $app->emails->send($email);
        // expect no exception
    }

    /**
     * 
     */
    public function testHooks1()
    {
        $app = $this->getApp();
        $app->emails->registerSender('DummyEmailSender');

        $log = '';

        $app->hooks->add('emailSend', function (\BearFramework\Emails\Email $email) use (&$log) {
            $log .= '1' . $email->sender->email;
        });
        $app->hooks->add('emailSent', function (\BearFramework\Emails\Email $email) use (&$log) {
            $log .= '2' . $email->sender->email;
        });
        $email = $app->emails->make();
        $email->sender->email = 'example@example.com';
        $app->emails->send($email);
        $this->assertEquals($log, '1example@example.com2example@example.com');
    }

    /**
     * Invalid sender
     */
    public function testHooks2()
    {
        $app = $this->getApp();
        $app->emails->registerSender('DummyFaultyEmailSender');

        $log = '';

        $app->hooks->add('emailSend', function (\BearFramework\Emails\Email $email) use (&$log) {
            $log .= '1' . $email->sender->email;
        });
        $app->hooks->add('emailSent', function (\BearFramework\Emails\Email $email) use (&$log) {
            $log .= '2' . $email->sender->email;
        });
        $email = $app->emails->make();
        $email->sender->email = 'example@example.com';
        $this->setExpectedException('Exception');
        $app->emails->send($email);
    }

    /**
     * Canceled email
     */
    public function testHooks3()
    {
        $app = $this->getApp();
        $app->emails->registerSender('DummyEmailSender');

        $log = '';

        $app->hooks->add('emailSend', function (\BearFramework\Emails\Email $email, &$preventDefault) use (&$log) {
            $preventDefault = true;
            $log .= '1' . $email->sender->email;
        });
        $app->hooks->add('emailSent', function (\BearFramework\Emails\Email $email) use (&$log) {
            $log .= '2' . $email->sender->email;
        });
        $email = $app->emails->make();
        $email->sender->email = 'example@example.com';
        $app->emails->send($email);
        $this->assertEquals($log, '1example@example.com');
    }

}
