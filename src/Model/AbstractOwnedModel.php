<?php

declare(strict_types=1);
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
