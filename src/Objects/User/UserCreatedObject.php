<?php

namespace Fashionphile\LaravelKafka\Objects\User;

use Fashionphile\LaravelKafka\Objects\KafkaObject;

class UserCreatedObject extends KafkaObject
{
    private string|null $uuid = null;
    private string|null $firstName = null;
    private string|null $lastName = null;
    private string|null $email = null;
    private string|null $phone = null;
    private int|null $createdTimestamp = null;

    public function setUuid(string $uuid) : self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getUuid() : ?string
    {
        return $this->uuid;
    }

    public function setFirstName(string $firstName) : self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getFirstName() : ?string
    {
        return $this->firstName;
    }

    public function setLastName(string $lastName) : self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getLastName() : ?string
    {
        return $this->lastName;
    }

    public function setEmail(string $email) : self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail() : ?string
    {
        return $this->email;
    }

    public function setPhone(string $phone) : self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPhone() : ?string
    {
        return $this->phone;
    }

    public function setCreatedTimestamp(int $timestamp) : self
    {
        $this->createdTimestamp = $timestamp;

        return $this;
    }

    public function getCreatedTimestamp() : ?int
    {
        return $this->createdTimestamp;
    }
}
