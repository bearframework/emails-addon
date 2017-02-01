<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

/**
 */
class Signers
{

    /**
     *
     * @var array 
     */
    private $data = [];

    /**
     * Add a SMIME signer.
     * 
     * @param string $certificate
     * @param string $private
     */
    public function addSMIME(string $certificate, string $privateKey): void
    {
        $signer = new \BearFramework\Emails\Email\SMIMESigner();
        $signer->certificate = $certificate;
        $signer->privateKey = $privateKey;
        $this->data[] = $signer;
    }

    /**
     * Add a DKIM signer.
     * 
     * @param string $privateKey
     * @param string $domain
     * @param string $selector
     */
    public function addDKIM(string $privateKey, string $domain, string $selector): void
    {
        $signer = new \BearFramework\Emails\Email\DKIMSigner();
        $signer->privateKey = $privateKey;
        $signer->domain = $domain;
        $signer->selector = $selector;
        $this->data[] = $signer;
    }

    /**
     * Removes the added signers.
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * Returns a list of added signers.
     * 
     * @return array A list of added signers.
     */
    public function getList()
    {
        $list = new \IvoPetkov\DataList();
        foreach ($this->data as $signer) {
            $list[] = clone($signer);
        }
        return $list;
    }

}
