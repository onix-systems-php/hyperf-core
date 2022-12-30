<?php

declare(strict_types=1);
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
            ],
        ];
    }
}
