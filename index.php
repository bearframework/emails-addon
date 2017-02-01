<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

use BearFramework\App;

$app = App::get();
$context = $app->context->get(__FILE__);

$context->classes
        ->add('BearFramwork\Emails', 'classes/Emails.php')
        ->add('BearFramwork\Emails\ISender', 'classes/Emails/ISender.php')
        ->add('BearFramwork\Emails\Email', 'classes/Emails/Email.php')
        ->add('BearFramwork\Emails\Email\Attachments', 'classes/Emails/Email/Attachments.php')
        ->add('BearFramwork\Emails\Email\Content', 'classes/Emails/Email/Content.php')
        ->add('BearFramwork\Emails\Email\ContentAttachment', 'classes/Emails/Email/ContentAttachment.php')
        ->add('BearFramwork\Emails\Email\ContentEmbed', 'classes/Emails/Email/ContentEmbed.php')
        ->add('BearFramwork\Emails\Email\ContentPart', 'classes/Emails/Email/ContentPart.php')
        ->add('BearFramwork\Emails\Email\DKIMSigner', 'classes/Emails/Email/DKIMSigner.php')
        ->add('BearFramwork\Emails\Email\Embeds', 'classes/Emails/Email/Embeds.php')
        ->add('BearFramwork\Emails\Email\FileAttachment', 'classes/Emails/Email/FileAttachment.php')
        ->add('BearFramwork\Emails\Email\FileEmbed', 'classes/Emails/Email/FileEmbed.php')
        ->add('BearFramwork\Emails\Email\Recipient', 'classes/Emails/Email/Recipient.php')
        ->add('BearFramwork\Emails\Email\Recipients', 'classes/Emails/Email/Recipients.php')
        ->add('BearFramwork\Emails\Email\SMIMESigner', 'classes/Emails/Email/SMIMESigner.php')
        ->add('BearFramwork\Emails\Email\Sender', 'classes/Emails/Email/Sender.php')
        ->add('BearFramwork\Emails\Email\Signer', 'classes/Emails/Email/Signer.php')
        ->add('BearFramwork\Emails\Email\Signers', 'classes/Emails/Email/Signers.php');

$app->shortcuts
        ->add('emails', function() {
            return new \BearFramework\Emails();
        });
