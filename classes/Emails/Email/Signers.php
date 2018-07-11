<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

use BearFramework\Models\ModelsRepository;

/**
 */
class Signers extends ModelsRepository
{

    /**
     * 
     */
    public function __construct()
    {
        $this->setModel(Signer::class);
        $this->useMemoryDataDriver();
    }

    /**
     * Add a SMIME signer.
     * 
     * @param string $certificate
     * @param string $privateKey
     */
    public function addSMIME(string $certificate, string $privateKey): void
    {
        $signer = new SMIMESigner();
        $signer->certificate = $certificate;
        $signer->privateKey = $privateKey;
        $this->set($signer);
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
        $this->set($signer);
    }

    /**
     * 
     * @param array $data
     */
    public function __fromArray(array $data): void
    {
        foreach ($data as $item) {
            if (is_array($item) && isset($item['type'])) {
                switch ($item['type']) {
                    case 'SMIME':
                        $this->set(SMIMESigner::fromArray($item));
                        break;
                    case 'DKIM':
                        $this->set(DKIMSigner::fromArray($item));
                        break;
                    default :
                        $this->set(Signer::fromArray($item));
                        break;
                }
            }
        }
    }

    /**
     * 
     * @param string $data
     */
    public function __fromJSON(string $data): void
    {
        $this->__fromArray(json_decode($data, true));
    }

}
