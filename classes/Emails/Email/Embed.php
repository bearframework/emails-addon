<?php

/*
 * Emails addon for Bear Framework
 * https://github.com/bearframework/emails-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace BearFramework\Emails\Email;

use BearFramework\Models\Model;

class Embed extends Model
{

    public function __construct()
    {
        $this
            ->defineProperty('id', [
                'type' => 'string',
                'init' => function () {
                    return md5(uniqid());
                }
            ]);
    }

    /**
     * 
     * @param string $data
     * @return \BearFramework\Models\Model
     */
    public static function fromJSON(string $data): \BearFramework\Models\Model
    {
        if (get_called_class() === self::class) {
            $decodedData = json_decode($data, true);
            if (is_array($decodedData) && isset($decodedData['type'])) {
                switch ($decodedData['type']) {
                    case 'file':
                        return FileEmbed::fromJSON($data);
                    case 'content':
                        return ContentEmbed::fromJSON($data);
                }
            }
            throw new \Exception('Invalid data provided!');
        } else {
            return parent::fromJSON($data);
        }
    }
}
