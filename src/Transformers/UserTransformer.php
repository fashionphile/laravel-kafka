<?php

namespace Fashionphile\LaravelKafka\Transformers;

use Fashionphile\LaravelKafka\Objects\User\UserCreatedObject;
use Fashionphile\LaravelKafka\Objects\User\UserUpdatedObject;

class UserTransformer
{
    public function transform(UserCreatedObject|UserUpdatedObject $object) : array
    {
        $out = [
            'uuid' => $object->getUuid(),
            'first_name' => $object->getFirstName(),
            'last_name' => $object->getLastName(),
            'email' => $object->getEmail(),
            'phone' => $object->getPhone(),
        ];

        if ($object instanceof UserCreatedObject) {
            $out['created_timestamp'] = $object->getCreatedTimestamp();
        }

        return $out;
    }
}
