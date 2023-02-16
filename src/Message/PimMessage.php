<?php

namespace App\Message;

use JsonException;

class PimMessage
{
    private string $content;

    /**
     * @throws JsonException
     */
    public function __construct(array $content = [])
    {
        $this->content = (string)json_encode($content, JSON_THROW_ON_ERROR);
    }

    public function getContent(): string
    {
        return $this->content;
    }
}