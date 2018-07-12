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
        parent::__construct();
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
     * @return \BearFramework\Models\Model
     * @throws \Exception
     */
    public function makeFromArray(array $data): \BearFramework\Models\Model
    {
        if (is_array($data) && isset($data['type'])) {
            switch ($data['type']) {
                case 'SMIME':
                    return SMIMESigner::fromArray($data);
                case 'DKIM':
                    return DKIMSigner::fromArray($data);
            }
        }
        throw new \Exception('Invalid data provided!');
    }

    /**
     * 
     * @param string $data
     * @return \BearFramework\Models\Model
     */
    public function makeFromJSON(string $data): \BearFramework\Models\Model
    {
        $decodedData = json_decode($data, true);
        if (is_array($decodedData) && isset($decodedData['type'])) {
            switch ($decodedData['type']) {
                case 'SMIME':
                    return SMIMESigner::fromJSON($data);
                case 'DKIM':
                    return DKIMSigner::fromJSON($data);
            }
        }
        throw new \Exception('Invalid data provided!');
    }

}
