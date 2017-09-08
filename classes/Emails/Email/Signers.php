<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) 2017 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

use BearFramework\Emails\Email\SMIMESigner;
use BearFramework\Emails\Email\DKIMSigner;

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
        $signer = new SMIMESigner();
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
        $signer = new DKIMSigner();
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

    /**
     * Returns the object data converted as an array
     * 
     * @return array The object data converted as an array
     */
    public function toArray()
    {
        $result = [];
        foreach ($this->data as $signer) {
            $signerData = $signer->toArray();
            $type = 'unknown';
            if ($signer instanceof SMIMESigner) {
                $type = 'SMIME';
            } elseif ($signer instanceof DKIMSigner) {
                $type = 'DKIM';
            }
            $signerData = array_merge(['type' => $type], $signerData);
            $result[] = $signerData;
        }
        return $result;
    }

    /**
     * Returns the object data converted as JSON
     * 
     * @return string The object data converted as JSON
     */
    public function toJSON()
    {
        return json_encode($this->toArray());
    }

}
