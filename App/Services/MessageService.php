<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\MessageDAO;
use App\Entities\Message;

class MessageService
{
    private messageDAO $messageDAO;

    public function __construct() {
        $this->messageDAO = new MessageDAO();
    }

    public function createMessage(string $name, string $company, string $email, string $message)
    {
        $this->messageDAO->addMessage($name, $company, $email, $message);
    }
}