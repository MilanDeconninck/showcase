<?php

declare(strict_types=1);

namespace App\Entities;

class Message
{
    public function __construct(
        private int $messageId,
        private string $name,
        private string $company,
        private string $email,
        private string $message
    ) {
    }

    public function getMessageId(): int
    {
        return $this->messageId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setCompany(string $company)
    {
        $this->company = $company;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
    }
}