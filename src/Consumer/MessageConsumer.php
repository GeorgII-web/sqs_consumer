<?php
namespace App\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class MessageConsumer implements ConsumerInterface
{
    public function execute(AMQPMessage $msg)
    {
        $message = json_decode($msg->body, true, 512, JSON_THROW_ON_ERROR);
        dump($message['_meta']??'empty');
//        echo '.';
//            return false; todo fail

    }
}