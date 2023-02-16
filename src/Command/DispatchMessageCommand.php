<?php

namespace App\Command;

use App\Message\PimMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

#[AsCommand(name: 'message:dispatch')]
class DispatchMessageCommand extends Command
{
    private $requirePassword;

    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly MessageBusInterface $bus
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('Consumer listens to SQS queue for a changes in a Product, Offer, etc.');
        $this->addArgument('count', InputArgument::OPTIONAL, 'Count of a messages', 1);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $start = microtime(true);
        $messagesCount = $input->getArgument('count');
        $output->writeln('Dispatching messages..., count=' . $messagesCount);
        $this->logger->debug('Dispatching messages..., count=' . $messagesCount);

        try {
            for ($i = 0; $i < $messagesCount; $i++) {
                $message = new PimMessage([
                    'id' => random_int(100000, 999999),
                    'name' => 'name_' . $i,
                    'data' => [
                        'field1' => 'value',
                        'field2' => 'value',
                        'field3' => 'value',
                        'field4' => 'value',
                        'field5' => 'value',
                        'field6' => 'value',
                        'field7' => 'value',
                    ],
                ]);

                $this->bus->dispatch($message);

                echo '.';
                //                $output->writeln('Dispatched, id=' . json_decode($message->getContent(), true, 512, JSON_THROW_ON_ERROR)['id']);
                //                $this->logger->debug('Dispatched, ' . $message->getContent());
            }
        } catch (Throwable $e) {
            $this->logger->error('Dispatch failed, ' . $e->getMessage());

            return Command::FAILURE;
        }

        dump('Took ' . round(microtime(true) - $start, 3) . ' sec');

        return Command::SUCCESS;
    }
}