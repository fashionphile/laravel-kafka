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
        $cachedRegistry = new CachedRegistry(
            new BlockingRegistry(
                new PromisingRegistry(
                    new Client(['base_uri' => config('fashionphile-kafka.schema_registry')])
                )
            ),
            new AvroObjectCacheAdapter()
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
