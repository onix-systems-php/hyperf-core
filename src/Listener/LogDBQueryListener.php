<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Listener;

use Hyperf\Collection\Arr;
use Hyperf\Database\Events\QueryExecuted;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Stringable\Str;
use Psr\Log\LoggerInterface;

class LogDBQueryListener implements ListenerInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory->get('Sql', 'sql');
    }

    public function listen(): array
    {
        return [
            QueryExecuted::class,
        ];
    }

    public function process(object $event): void
    {
        if ($event instanceof QueryExecuted) {
            $sql = $event->sql;
            if (! Arr::isAssoc($event->bindings)) {
                foreach ($event->bindings as $value) {
                    $sql = Str::replaceFirst('?', "'{$value}'", $sql);
                }
            }

            $this->logger->info(sprintf('[%s] %s', $event->time, $sql));
        }
    }
}
