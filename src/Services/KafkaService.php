<?php

namespace Fashionphile\LaravelKafka\Services;

use Fashionphile\LaravelKafka\Serializers\Serializer;
use Fashionphile\LaravelKafka\Transformers\UserTransformer;
use Illuminate\Support\Str;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class KafkaService
{
    public function __construct(
        protected string $cluster,
        protected string $brokers,
        protected Serializer $serializer
    )
    {}

    public function sendMessage(
        string $topic,
        array $message,
        string $bodySchemaName,
        ?string $keySchemaName = null
    ) : void
    {
        $message = (new Message())->setTopicName("$topic-value")->withBody(json_encode($message));
        $serializer = $this->serializer->serializerByTopic($topic, $bodySchemaName, $keySchemaName);
        $producer = Kafka::publishOn($topic, $this->brokers);
        $producer->withMessage($message)->send();
    }
}
