<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Exception;

use Hyperf\Server\Exception\ServerException;
use OnixSystemsPHP\HyperfCore\Constants\ErrorCode;

class BusinessException extends ServerException
{
    public function __construct(int $code = 0, ?string $message = null, ?\Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = ErrorCode::getMessage($code);
        }

        parent::__construct($message, $code, $previous);
    }
}
