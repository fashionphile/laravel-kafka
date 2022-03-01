# laravel-kafka

A Fashionphile-specific package that utilized `laravel-kafka` package under the hood to produce Kafka events.

## Installation

Note - the `composer require` command will work only when package is added to Packagist.

* `composer require fashionphile/laravel-kafka`
* `php artisan vendor:publish --tag=fashionphile-kafka-config`

## Usage

Make sure you configure your Kafka broker inside your `.env`.

```phpregexp
$userCreatedObject = (new UserCreatedObject())
    ->setUuid($uuid)
    ->setFirstName($firstName)
    ->setLastName($lastName)
    ->setEmail($email)
    ->setPhone($phone)
    ->setCreatedTimestamp($timestamp);

FashionphileKafka::sendUserCreatedEvent($usetCreatedObject);
```
