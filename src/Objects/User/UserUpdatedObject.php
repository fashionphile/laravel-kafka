<?php

namespace Fashionphile\LaravelKafka\Objects\User;

use Fashionphile\LaravelKafka\Objects\KafkaObject;

class UserUpdatedObject extends KafkaObject
{
    private string|null $uuid = null;
    private string|null $firstName = null;
    private string|null $lastName = null;
    private string|null $email = null;
    private string|null $phone = null;

    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public function getUuid() : ?string
    {
        return $this->uuid;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName() : ?string
    {
        return $this->firstName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName() : ?string
    {
        return $this->lastName;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail() : ?string
    {
        return $this->email;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    public function getPhone() : ?string
    {
        return $this->phone;
    }
}
