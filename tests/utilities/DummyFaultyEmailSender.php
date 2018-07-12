<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

class DummyFaultyEmailSender implements \BearFramework\Emails\ISender
{

    public function send(\BearFramework\Emails\Email $email): bool
    {
        return false;
    }

}
