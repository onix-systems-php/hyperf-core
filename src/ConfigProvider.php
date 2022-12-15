<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace OnixSystemsPHP\HyperfCore;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
            ],
            'commands' => [
                \OnixSystemsPHP\HyperfCore\Command\AnonymizeDataCommand::class,
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'listeners' => [
                \OnixSystemsPHP\HyperfActionsLog\Listener\LogDBQueryListener::class,
                \OnixSystemsPHP\HyperfActionsLog\Listener\LogQueueListener::class,
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for anonymization from onix-systems-php/hyperf-core.',
                    'source' => __DIR__ . '/../publish/anonymization.php',
                    'destination' => BASE_PATH . '/config/autoload/anonymization.php',
                ],
            ],
        ];
    }
}
