<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
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
                \OnixSystemsPHP\HyperfCore\Command\SwaggerGenCommand::class,
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'listeners' => [
            ],
            'publish' => [
                [
                    'id' => 'anonymization',
                    'description' => 'The config for anonymization from onix-systems-php/hyperf-core.',
                    'source' => __DIR__ . '/../publish/anonymization.php',
                    'destination' => BASE_PATH . '/config/autoload/anonymization.php',
                ],
                [
                    'id' => 'swagger',
                    'description' => 'The config for swagger from onix-systems-php/hyperf-core.',
                    'source' => __DIR__ . '/../publish/swagger.php',
                    'destination' => BASE_PATH . '/config/autoload/swagger.php',
                ],
                [
                    'id' => 'core',
                    'description' => 'The config for onix-systems-php/hyperf-core.',
                    'source' => __DIR__ . '/../publish/core.php',
                    'destination' => BASE_PATH . '/config/autoload/core.php',
                ],
            ],
        ];
    }
}
