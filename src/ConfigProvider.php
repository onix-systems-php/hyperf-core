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
                    'id' => 'config',
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
                    'id' => 'extensions',
                    'description' => 'The config for extensions from onix-systems-php/hyperf-core.',
                    'source' => __DIR__ . '/../publish/extensions.php',
                    'destination' => BASE_PATH . '/config/autoload/extensions.php',
                ],
            ],
        ];
    }
}
