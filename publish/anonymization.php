<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    // Use array key as anonymization config name
    'main' => [
        /*
         * List repositories you need to anonymize here.
         *
         * Default method is anonymize from OnixSystemsPHP\HyperfCore\Model\AbstractModel,
         * you can use other method by using class as a key and method name as a value.
         * Notice! Custom method has to follow OnixSystemsPHP\HyperfCore\Model\AbstractModel::anonymize signature
         *
         * Please, don't use AbstractRepository in real config directly
         */
        \OnixSystemsPHP\HyperfCore\Repository\AbstractRepository::class,
    ],
];
