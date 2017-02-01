<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails;

/**
 * Email sender interface
 */
interface ISender
{

    /**
     * Sends a email
     * 
     * @param \BearFramework\Emails\Email $email
     * @return bool Returns true if the email is send. FALSE otherwise.
     */
    public function send(\BearFramework\Emails\Email $email): bool;
}
