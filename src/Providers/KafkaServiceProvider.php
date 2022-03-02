<?php

namespace Fashionphile\LaravelKafka\Providers;

use Fashionphile\LaravelKafka\Services\KafkaService;
use Illuminate\Support\ServiceProvider;

class KafkaServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        $this->publishesConfiguration();
    }

    public function register() : void
    {
        $cluster = config('fashionphile-kafka.cluster');
        $topics = config('fashionphile-kafka.topics');
        $brokers = config('fashionphile-kafka.brokers');

        $this->app->singleton(KafkaService::class, function () use ($cluster, $topics, $brokers) {
            return new KafkaService($cluster, $topics, $brokers);
        });
    }

    public function publishesConfiguration() : void
    {
        $this->publishes([
            __DIR__."/../../config/fashionphile-kafka.php" => config_path('fashionphile-kafka.php'),
        ], 'fashionphile-kafka-config');
    }
}
