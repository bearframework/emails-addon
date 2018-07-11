<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

use BearFramework\App;

$app = App::get();
$context = $app->context->get(__FILE__);

$context->classes
        ->add('BearFramework\Emails', 'classes/Emails.php')
        ->add('BearFramework\Emails\Email', 'classes/Emails/Email.php')
        ->add('BearFramework\Emails\ISender', 'classes/Emails/ISender.php')
        ->add('BearFramework\Emails\Email\Attachment', 'classes/Emails/Email/Attachment.php')
        ->add('BearFramework\Emails\Email\Attachments', 'classes/Emails/Email/Attachments.php')
        ->add('BearFramework\Emails\Email\BccRecipient', 'classes/Emails/Email/BccRecipient.php')
        ->add('BearFramework\Emails\Email\BccRecipients', 'classes/Emails/Email/BccRecipients.php')
        ->add('BearFramework\Emails\Email\CcRecipient', 'classes/Emails/Email/CcRecipient.php')
        ->add('BearFramework\Emails\Email\CcRecipients', 'classes/Emails/Email/CcRecipients.php')
        ->add('BearFramework\Emails\Email\Content', 'classes/Emails/Email/Content.php')
        ->add('BearFramework\Emails\Email\ContentAttachment', 'classes/Emails/Email/ContentAttachment.php')
        ->add('BearFramework\Emails\Email\ContentEmbed', 'classes/Emails/Email/ContentEmbed.php')
        ->add('BearFramework\Emails\Email\ContentPart', 'classes/Emails/Email/ContentPart.php')
        ->add('BearFramework\Emails\Email\DKIMSigner', 'classes/Emails/Email/DKIMSigner.php')
        ->add('BearFramework\Emails\Email\Embed', 'classes/Emails/Email/Embed.php')
        ->add('BearFramework\Emails\Email\Embeds', 'classes/Emails/Email/Embeds.php')
        ->add('BearFramework\Emails\Email\FileAttachment', 'classes/Emails/Email/FileAttachment.php')
        ->add('BearFramework\Emails\Email\FileEmbed', 'classes/Emails/Email/FileEmbed.php')
        ->add('BearFramework\Emails\Email\Header', 'classes/Emails/Email/Header.php')
        ->add('BearFramework\Emails\Email\Headers', 'classes/Emails/Email/Headers.php')
        ->add('BearFramework\Emails\Email\Recipient', 'classes/Emails/Email/Recipient.php')
        ->add('BearFramework\Emails\Email\Recipients', 'classes/Emails/Email/Recipients.php')
        ->add('BearFramework\Emails\Email\ReplyToRecipient', 'classes/Emails/Email/ReplyToRecipient.php')
        ->add('BearFramework\Emails\Email\ReplyToRecipients', 'classes/Emails/Email/ReplyToRecipients.php')
        ->add('BearFramework\Emails\Email\SMIMESigner', 'classes/Emails/Email/SMIMESigner.php')
        ->add('BearFramework\Emails\Email\Sender', 'classes/Emails/Email/Sender.php')
        ->add('BearFramework\Emails\Email\Signer', 'classes/Emails/Email/Signer.php')
        ->add('BearFramework\Emails\Email\Signers', 'classes/Emails/Email/Signers.php');

$app->shortcuts
        ->add('emails', function() {
            return new \BearFramework\Emails();
        });
