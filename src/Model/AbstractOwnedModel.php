<?php

declare(strict_types=1);
namespace OnixSystemsPHP\HyperfCore\Model;

use App\Model\User;
use Hyperf\Database\Model\Relations\BelongsTo;

/**
 * @property int $user_id
 */
abstract class AbstractOwnedModel extends AbstractModel
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
