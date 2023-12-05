<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Model;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Database\Model\Relations\BelongsTo;
use OnixSystemsPHP\HyperfCore\Contract\CoreAuthenticatable;

/**
 * @property int $user_id
 * @property ?CoreAuthenticatable $user
 */
abstract class AbstractOwnedModel extends AbstractModel
{
    public function user(): BelongsTo
    {
        $class = $this->getContainer()->get(ConfigInterface::class)->get('core.user_model');

        return $this->belongsTo($class, 'user_id', 'id');
    }
}
