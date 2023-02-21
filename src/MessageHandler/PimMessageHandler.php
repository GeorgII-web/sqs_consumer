<?php

namespace App\MessageHandler;

use App\Message\PimMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class PimMessageHandler
{
    public function __construct()
    {
    }

    public function __invoke(PimMessage $message): void
    {
        echo ".";
    }
}