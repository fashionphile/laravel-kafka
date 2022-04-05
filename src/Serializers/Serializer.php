<?php

namespace Fashionphile\LaravelKafka\Serializers;

use Junges\Kafka\Message\Serializers\AvroSerializer;
use Junges\Kafka\Message\KafkaAvroSchema;
use Junges\Kafka\Message\Registry\AvroSchemaRegistry;
use FlixTech\AvroSerializer\Objects\RecordSerializer;
use FlixTech\SchemaRegistryApi\Registry\CachedRegistry;
use FlixTech\SchemaRegistryApi\Registry\BlockingRegistry;
use FlixTech\SchemaRegistryApi\Registry\PromisingRegistry;
use FlixTech\SchemaRegistryApi\Registry\Cache\AvroObjectCacheAdapter;
use GuzzleHttp\Client;

class Serializer
{
    public function serializerByTopic(
        string $topic,
        string $bodySchemaName,
        ?string $keySchemaName = null
    ) : AvroSerializer
    {
        $config = ['base_uri' => config('fashionphile-kafka.schema_registry')];

        if (config('fashionphile-kafka.schema_registry.use_auth')) {
            $config['auth'] = [
                config('fashionphile-kafka.schema-registry.username'),
                config('fashionphile-kafka.schema_registry.password'),
            ];
        }

        $cachedRegistry = new CachedRegistry(
            new BlockingRegistry(new PromisingRegistry(new Client($config))), new AvroObjectCacheAdapter()
        );

        $registry = new AvroSchemaRegistry($cachedRegistry);
        $recordSerializer = new RecordSerializer($cachedRegistry);

        $registry->addBodySchemaMappingForTopic($topic, new KafkaAvroSchema($bodySchemaName));

        if ($keySchemaName !== null) {
            $registry->addKeySchemaMappingForTopic($topic, new KafkaAvroSchema($keySchemaName));
        }

        $serializer = new AvroSerializer($registry, $recordSerializer);

        return $serializer;
    }
}
