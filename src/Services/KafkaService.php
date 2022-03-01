<?php

namespace Fashionphile\LaravelKafka\Services;

use Fashionphile\LaravelKafka\Objects\User\UserCreatedObject;
use Fashionphile\LaravelKafka\Objects\User\UserUpdatedObject;
use Fashionphile\LaravelKafka\Transformers\UserTransformer;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class KafkaService
{
    public function __construct(
        protected string $cluster,
        protected array $topics,
    )
    {}

    public function sendUserCreatedEvent(UserCreatedObject $userCreatedObject) : void
    {
        $this->sendMessage($this->topics['user.created'], (new UserTransformer())->transform($userCreatedObject));
    }

    public function sendUserUpdatedEvent(UserUpdatedObject $userUpdatedObject) : void
    {
        $this->sendMessage($this->topics['user.updated'], (new UserTransformer())->transform($userUpdatedObject));
    }

    private function sendMessage($topic, $message) : void
    {
        $message = new Message(
            body: $message,
        );

        Kafka::publishOn($topic)->withMessage($message);
    }
}
