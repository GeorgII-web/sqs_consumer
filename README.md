# Consumer SQS messages

Example project to test SQS messages

## Install

- Clone the project `git clone git@github.com:GeorgII-web/sqs_consumer.git`
- Install packages `composer install`

## Run

- Start SQS container `docker-compose up`
- Create `.env.local` with a `MESSENGER_TRANSPORT_DSN=` value
- Start Message generator `bin/console message:dispatch`, example `bin/console message:dispatch 100`
- Start Consumer `bin/console messenger:consume pim -vv`, example `time && php bin/console messenger:consume pim --limit=100 --no-debug && time`

## Debug

- `bin/console debug:messenger`