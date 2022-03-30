<?php

namespace Fashionphile\LaravelKafka\Services;

use Fashionphile\LaravelKafka\Serializers\Serializer;
use Fashionphile\LaravelKafka\Transformers\UserTransformer;
use Illuminate\Support\Str;
use Junges\Kafka\Config\Sasl;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class KafkaService
{
    public function __construct(
        protected string $brokers,
        protected Serializer $serializer,
        protected bool $useSasl = false,
        protected array $saslConfig = []
    )
    {}

    public function sendMessage(
        string $topic,
        array $message,
        string $bodySchemaName,
        ?string $keySchemaName = null
    ) : void
    {
        $message = (new Message())->setTopicName($topic)->withBody($message);
        $serializer = $this->serializer->serializerByTopic($topic, $bodySchemaName, $keySchemaName);
        $producer = Kafka::publishOn($topic, $this->brokers)->usingSerializer($serializer)->withMessage($message);

        if (config('fashionphile-kafka.sasl.enabled')) {
            $username = config('fashionphile-kafka.sasl.username');
            $password = config('fashionphile-kafka.sasl.password');
            $useSsl = config('fashionphile-kafka.sasl.use_ssl');
            $protocol = $useSsl ? 'SASL_SSL' : 'SASL_PLAINTEXT';

            $saslConfig = new Sasl(
                username: $username,
                password: $password,
                mechanisms: 'authentication mechanism',
                securityProtocol: $protocol,
            );

            $producer->withSasl();
        }

        $producer->send();
    }
}
