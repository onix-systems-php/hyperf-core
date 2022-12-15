<?php
declare(strict_types=1);

namespace OnixSystemsPHP\HyperfCore\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

#[Constants]
class Time extends AbstractConstants
{
    public const SECOND = 1;

    public const MINUTE = self::SECOND * 60;

    public const HOUR = self::MINUTE * 60;

    public const DAY = self::HOUR * 24;

    public const WEEK = self::DAY * 7;

    public const MONTH = self::DAY * 31;

    public const YEAR = self::DAY * 365;
}
