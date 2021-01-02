<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

/**
 * @runTestsInSeparateProcesses
 */
class EmailsTest extends BearFramework\AddonTests\PHPUnitTestCase
{

    /**
     * 
     */
    public function testConstruct()
    {
        $app = $this->getApp();

        $fillEmailWithData = function ($email) {
            $email->subject = 'The subject';
            $email->date = 1514481017;
            $email->sender->email = 'sender@example.com';
            $email->sender->name = 'John Smith';
            $email->replyToRecipients->add('replyto@example.com', 'John');
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
            $email->headers->add('X-Custom-1', 'value1');
            $email->headers->add('X-Custom-2', 'value2');
        };

        $checkIsEmpty = function ($email) {
            $this->assertEquals($email->subject, null);
            $this->assertEquals($email->date, null);
            $this->assertEquals($email->sender->email, null);
            $this->assertEquals($email->sender->name, null);
            $replyToRecipients = $email->replyToRecipients->getList();
            $this->assertEquals($replyToRecipients->count(), 0);
            $ccRecipients = $email->ccRecipients->getList();
            $this->assertEquals($ccRecipients->count(), 0);
            $bccRecipients = $email->bccRecipients->getList();
            $this->assertEquals($bccRecipients->count(), 0);
            $this->assertEquals($email->returnPath, null);
            $this->assertEquals($email->priority, null);
            $recipients = $email->recipients->getList();
            $this->assertEquals($recipients->count(), 0);
            $contentParts = $email->content->getList();
            $this->assertEquals($contentParts->count(), 0);
            $attachments = $email->attachments->getList();
            $this->assertEquals($attachments->count(), 0);
            $embeds = $email->embeds->getList();
            $this->assertEquals($embeds->count(), 0);
            $signers = $email->signers->getList();
            $this->assertEquals($signers->count(), 0);
            $headers = $email->headers->getList();
            $this->assertEquals($headers->count(), 0);
        };

        $checkIfDataIsCorrect = function ($email) {
            $this->assertEquals($email->subject, 'The subject');
            $this->assertEquals($email->date, 1514481017);
            $this->assertEquals($email->sender->email, 'sender@example.com');
            $this->assertEquals($email->sender->name, 'John Smith');
            $replyToRecipients = $email->replyToRecipients->getList();
            $this->assertEquals($replyToRecipients[0]->email, 'replyto@example.com');
            $this->assertEquals($replyToRecipients[0]->name, 'John');
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
            $this->assertTrue($attachments[0] instanceof \BearFramework\Emails\Email\FileAttachment);
            $this->assertEquals($attachments[0]->filename, '/path/to/file1.jpg');
            $this->assertEquals($attachments[0]->name, 'file1.jpg');
            $this->assertEquals($attachments[0]->mimeType, 'image/jpeg');
            $this->assertTrue($attachments[1] instanceof \BearFramework\Emails\Email\ContentAttachment);
            $this->assertEquals($attachments[1]->content, 'text1');
            $this->assertEquals($attachments[1]->name, 'text1.txt');
            $this->assertEquals($attachments[1]->mimeType, 'text/plain');
            $embeds = $email->embeds->getList();
            $this->assertTrue($embeds[0] instanceof \BearFramework\Emails\Email\FileEmbed);
            $this->assertEquals($embeds[0]->cid, 'embed1');
            $this->assertEquals($embeds[0]->filename, '/path/to/file2.jpg');
            $this->assertEquals($embeds[0]->name, 'file2.jpg');
            $this->assertEquals($embeds[0]->mimeType, 'image/jpeg');
            $this->assertTrue($embeds[1] instanceof \BearFramework\Emails\Email\ContentEmbed);
            $this->assertEquals($embeds[1]->cid, 'embed2');
            $this->assertEquals($embeds[1]->content, 'text2');
            $this->assertEquals($embeds[1]->name, 'text2.txt');
            $this->assertEquals($embeds[1]->mimeType, 'text/plain');
            $signers = $email->signers->getList();
            $this->assertTrue($signers[0] instanceof \BearFramework\Emails\Email\SMIMESigner);
            $this->assertEquals($signers[0]->certificate, 'content of certificate.pem');
            $this->assertEquals($signers[0]->privateKey, 'content of private-key.pem');
            $this->assertTrue($signers[1] instanceof \BearFramework\Emails\Email\DKIMSigner);
            $this->assertEquals($signers[1]->privateKey, 'content of private-key.pem');
            $this->assertEquals($signers[1]->domain, 'example.com');
            $this->assertEquals($signers[1]->selector, 'default');
            $headers = $email->headers->getList();
            $this->assertEquals($headers[0]->name, 'X-Custom-1');
            $this->assertEquals($headers[0]->value, 'value1');
            $this->assertEquals($headers[1]->name, 'X-Custom-2');
            $this->assertEquals($headers[1]->value, 'value2');
        };

        $removeEmailData = function ($email) {
            $email->subject = null;
            $email->date = null;
            $email->sender->email = null;
            $email->sender->name = null;
            $email->replyToRecipients->deleteAll();
            $email->returnPath = null;
            $email->priority = null;
            $email->recipients->deleteAll();
            $email->content->deleteAll();
            $email->attachments->deleteAll();
            $email->embeds->deleteAll();
            $email->signers->deleteAll();
            $email->headers->deleteAll();
        };

        $email = $app->emails->make();
        $checkIsEmpty($email);
        $fillEmailWithData($email);
        $checkIfDataIsCorrect($email);
        $removeEmailData($email);
        $checkIsEmpty($email);

        $email = $app->emails->make();
        $fillEmailWithData($email);
        $checkIfDataIsCorrect($app->emails->makeFromJSON($email->toJSON()));

        $email = $app->emails->make();
        $fillEmailWithData($email);
        $checkIfDataIsCorrect($app->emails->makeFromArray($email->toArray()));
    }

    /**
     * 
     */
    public function testSend1()
    {
        $app = $this->getApp();
        $app->emails->registerSender('DummyEmailSender');
        $email = $app->emails->make();
        $app->emails->send($email);
        // expect no exception
        $this->assertTrue(true);
    }

    /**
     * 
     */
    public function testSend2()
    {
        $app = $this->getApp();
        $sender = new DummyEmailSender();
        $app->emails->registerSender($sender);
        $email = $app->emails->make();
        $app->emails->send($email);
        // expect no exception
        $this->assertTrue(true);
    }

    /**
     *
     */
    public function testSend3()
    {
        $app = $this->getApp();
        $app->emails->registerSender(function () {
            return 'DummyEmailSender';
        });
        $email = $app->emails->make();
        $app->emails->send($email);
        // expect no exception
        $this->assertTrue(true);
    }

    /**
     * 
     */
    public function testSend4()
    {
        $app = $this->getApp();
        $app->emails->registerSender(function () {
            return new DummyEmailSender();
        });
        $email = $app->emails->make();
        $app->emails->send($email);
        // expect no exception
        $this->assertTrue(true);
    }

    /**
     * 
     */
    public function testEvents1()
    {
        $app = $this->getApp();
        $app->emails->registerSender('DummyEmailSender');

        $log = '';

        $app->emails->addEventListener('beforeSendEmail', function (\BearFramework\Emails\BeforeSendEmailEventDetails $details) use (&$log) {
            $log .= '1' . $details->email->sender->email;
        });
        $app->emails->addEventListener('sendEmail', function (\BearFramework\Emails\SendEmailEventDetails $details) use (&$log) {
            $log .= '2' . $details->email->sender->email;
        });
        $email = $app->emails->make();
        $email->sender->email = 'example@example.com';
        $app->emails->send($email);
        $this->assertEquals($log, '1example@example.com2example@example.com');
    }

    /**
     * Invalid sender
     */
    public function testEvents2()
    {
        $app = $this->getApp();
        $app->emails->registerSender('DummyFaultyEmailSender');

        $log = '';

        $app->emails->addEventListener('beforeSendEmail', function (\BearFramework\Emails\BeforeSendEmailEventDetails $details) use (&$log) {
            $log .= '1' . $details->email->sender->email;
        });
        $app->emails->addEventListener('sendEmail', function (\BearFramework\Emails\SendEmailEventDetails $details) use (&$log) {
            $log .= '2' . $details->email->sender->email;
        });
        $email = $app->emails->make();
        $email->sender->email = 'example@example.com';
        $this->expectException('Exception');
        $app->emails->send($email);
    }

    /**
     * Canceled email
     */
    public function testEvents3()
    {
        $app = $this->getApp();
        $app->emails->registerSender('DummyEmailSender');

        $log = '';

        $app->emails->addEventListener('beforeSendEmail', function (\BearFramework\Emails\BeforeSendEmailEventDetails $details) use (&$log) {
            $details->preventDefault = true;
            $log .= '1' . $details->email->sender->email;
        });
        $app->emails->addEventListener('sendEmail', function (\BearFramework\Emails\SendEmailEventDetails $details) use (&$log) {
            $log .= '2' . $details->email->sender->email;
        });
        $email = $app->emails->make();
        $email->sender->email = 'example@example.com';
        $app->emails->send($email);
        $this->assertEquals($log, '1example@example.com');
    }

    /**
     * 
     */
    public function testToArrayAndToJSON()
    {
        $app = $this->getApp();
        $email = $app->emails->make();

        $email->subject = 'The subject';
        $email->date = 1514481017;
        $email->sender->email = 'sender@example.com';
        $email->sender->name = 'John Smith';
        $email->replyToRecipients->add('replyto@example.com', 'John');
        $email->bccRecipients->add('bcc1@example.com', 'Henry');
        $email->bccRecipients->add('bcc2@example.com', 'Tom');
        $email->ccRecipients->add('cc1@example.com', 'Jane');
        $email->ccRecipients->add('cc2@example.com', 'Lisa');
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
        $email->headers->add('X-Custom-1', 'value1');
        $email->headers->add('X-Custom-2', 'value2');

        $expectedResult = [
            'attachments' => [
                [
                    'filename' => '/path/to/file1.jpg',
                    'mimeType' => 'image/jpeg',
                    'name' => 'file1.jpg',
                    'type' => 'file',
                ],
                [
                    'content' => 'text1',
                    'mimeType' => 'text/plain',
                    'name' => 'text1.txt',
                    'type' => 'content',
                ],
            ],
            'bccRecipients' => [
                [
                    'email' => 'bcc1@example.com',
                    'name' => 'Henry',
                ],
                [
                    'email' => 'bcc2@example.com',
                    'name' => 'Tom',
                ]
            ],
            'ccRecipients' => [
                [
                    'email' => 'cc1@example.com',
                    'name' => 'Jane',
                ],
                [
                    'email' => 'cc2@example.com',
                    'name' => 'Lisa',
                ]
            ],
            'content' => [
                [
                    'content' => '<strong>Hi</strong>',
                    'encoding' => 'utf-8',
                    'mimeType' => 'text/html',
                ],
                [
                    'content' => 'Hi',
                    'encoding' => null,
                    'mimeType' => 'text/plain',
                ],
            ],
            'date' => 1514481017,
            'embeds' => [
                [
                    'cid' => 'embed1',
                    'filename' => '/path/to/file2.jpg',
                    'mimeType' => 'image/jpeg',
                    'name' => 'file2.jpg',
                    'type' => 'file',
                ],
                [
                    'cid' => 'embed2',
                    'content' => 'text2',
                    'mimeType' => 'text/plain',
                    'name' => 'text2.txt',
                    'type' => 'content',
                ],
            ],
            'headers' => [
                [
                    'name' => 'X-Custom-1',
                    'value' => 'value1',
                ],
                [
                    'name' => 'X-Custom-2',
                    'value' => 'value2',
                ]
            ],
            'priority' => 3,
            'recipients' => [
                [
                    'email' => 'recipient1@example.com',
                    'name' => 'Mark Smith',
                ],
                [
                    'email' => 'recipient2@example.com',
                    'name' => 'Bill Smith',
                ],
            ],
            'replyToRecipients' => [
                [
                    'email' => 'replyto@example.com',
                    'name' => 'John',
                ]
            ],
            'returnPath' => 'bounce@example.com',
            'sender' => [
                'email' => 'sender@example.com',
                'name' => 'John Smith',
            ],
            'signers' => [
                [
                    'certificate' => 'content of certificate.pem',
                    'privateKey' => 'content of private-key.pem',
                    'type' => 'SMIME',
                ],
                [
                    'domain' => 'example.com',
                    'privateKey' => 'content of private-key.pem',
                    'selector' => 'default',
                    'type' => 'DKIM',
                ],
            ],
            'subject' => 'The subject',
        ];

        $emailAsArray = $email->toArray();
        $emailAsJSON = $email->toJSON();
        $removeIDProperties = function ($data) use (&$removeIDProperties) {
            foreach ($data as $key => $value) {
                if ($key === 'id') {
                    unset($data['id']);
                }
                if (is_array($value)) {
                    $data[$key] = $removeIDProperties($value);
                }
            }
            return $data;
        };

        $emailFromArray = $app->emails->makeFromArray($emailAsArray);
        $emailFromJSON = $app->emails->makeFromJSON($emailAsJSON);
        $this->assertTrue(serialize($expectedResult) === serialize($removeIDProperties($emailFromArray->toArray())));
        $this->assertTrue(serialize($expectedResult) === serialize($removeIDProperties($emailFromJSON->toArray())));
    }

    /**
     * 
     */
    public function testAddInvalidHeader()
    {
        $app = $this->getApp();
        $email = $app->emails->make();
        $this->expectException('InvalidArgumentException');
        $email->headers->add('From', 'example@example.com');
    }

    /**
     * 
     */
    public function testBinaryData()
    {
        $tempDir = $this->getTempDir();
        $app = $this->getApp();

        $email = $app->emails->make();
        $this->makeSampleFile($tempDir . '/file1.jpg', 'jpg');

        $binaryContent = file_get_contents($tempDir . '/file1.jpg');
        $email->attachments->addContent($binaryContent, 'file1.jpg', 'image/jpg');
        $this->assertTrue($email->attachments->getList()[0]->content === $binaryContent);
        $email->embeds->addContent('cid1', $binaryContent, 'file1.jpg', 'image/jpg');
        $this->assertTrue($email->embeds->getList()[0]->content === $binaryContent);

        $notBinaryContent = 'not binary';
        $email->attachments->addContent($notBinaryContent, 'file2.jpg', 'image/jpg');
        $this->assertTrue($email->attachments->getList()[1]->content === $notBinaryContent);
        $email->embeds->addContent('cid2', $notBinaryContent, 'file2.jpg', 'image/jpg');
        $this->assertTrue($email->embeds->getList()[1]->content === $notBinaryContent);
    }
}
