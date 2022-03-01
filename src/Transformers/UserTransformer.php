<?php

namespace Fashionphile\LaravelKafka\Transformers;

use Illuminate\Database\Eloquent\Model;

class UserTransformer
{
    public function transform(Model $model) : array
    {
        /** @var \App\Models\User $model */
        return [

        ];
    }
}
