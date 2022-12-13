<?php

declare(strict_types=1);

return [
    // Use array key as anonymization config name
    'main' => [
        /**
         * List repositories you need to anonymize here.
         *
         * Default method is anonymize from Hyperf\Core\Model\AbstractModel,
         * you can use other method by using class as a key and method name as a value.
         * Notice! Custom method has to follow Hyperf\Core\Model\AbstractModel::anonymize signature
         *
         * Please, don't use AbstractRepository in real config directly
         */
        \Hyperf\Core\Repository\AbstractRepository::class,
    ],
];
