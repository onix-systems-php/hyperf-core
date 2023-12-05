<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

#[Constants]
class ErrorCode extends AbstractConstants
{
    /**
     * @Message("Bad Request！")
     */
    public const BAD_REQUEST_ERROR = 400;

    /**
     * @Message("Unauthorized！")
     */
    public const UNAUTHORIZED_ERROR = 401;

    /**
     * @Message("Forbidden！")
     */
    public const FORBIDDEN_ERROR = 403;

    /**
     * @Message("Not found！")
     */
    public const NOT_FOUND_ERROR = 404;

    /**
     * @Message("Validation！")
     */
    public const VALIDATION_ERROR = 422;

    /**
     * @Message("Server Error！")
     */
    public const SERVER_ERROR = 500;
}
