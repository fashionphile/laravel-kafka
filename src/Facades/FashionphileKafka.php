<?php

namespace Fashionphile\LaravelKafka\Facades;

use Fashionphile\LaravelKafka\Objects\User\UserCreatedObject;
use Fashionphile\LaravelKafka\Objects\User\UserUpdatedObject;
use Fashionphile\LaravelKafka\Services\KafkaService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static KafkaService sendUserCreatedEvent(UserCreatedObject $object)
 * @method static KafkaService sendUserUpdatedEvent(UserUpdatedObject $object)
 *
 * @mixin KafkaService
 */
class FashionphileKafka extends Facade
{
    public static function getFacadeAccessor() : string
    {
        return KafkaService::class;
    }
}
