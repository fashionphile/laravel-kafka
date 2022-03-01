<?php

namespace Fashionphile\LaravelKafka\Services;

use Junges\Kafka\Facades\Kafka;

class KafkaService
{
    public function __construct(protected string $cluster, protected array $topics)
    {}

    public function sendUserEvent($message)
    {

    }

    private function sendMessage($message) : void
    {
        Kafka::publishOn($this->cluster)->onTopic($topic)->withMessage(
            body: $message
        );
    }
}
