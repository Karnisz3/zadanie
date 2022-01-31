<?php
declare(strict_types = 1);

use DI\ContainerBuilder;
use Psr\Log\LoggerInterface;
use Slim\Logger;

return (new ContainerBuilder())->addDefinitions([
    LoggerInterface::class => function () {
        return new Logger();
    }
])->build();