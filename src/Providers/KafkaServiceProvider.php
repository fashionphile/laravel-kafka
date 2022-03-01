<?php

namespace Fashionphile\LaravelKafka\Providers;

use Fashionphile\LaravelKafka\Services\KafkaService;
use Illuminate\Support\ServiceProvider;

class KafkaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $cluster = config('fashionphile-kafka.cluster');
        $topics = config('fashionphile-kafka.topics');

        $this->app->singleton(KafkaService::class, function () use ($cluster, $topics) {
            return new KafkaService($cluster, $topics);
        });
    }

    public function publishes(array $paths, $groups = null)
    {
        $this->publishes([
            __DIR__."/../../config/fashionphile-kafka.php" => config_path('fashionphile-kafka.php'),
        ], 'fashionphile-kafka-config');
    }
}
