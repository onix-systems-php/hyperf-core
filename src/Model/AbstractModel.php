<?php
declare(strict_types=1);

namespace Hyperf\Core\Model;

use Hyperf\Core\Model\Filter\AbstractFilter;
use Faker\Generator;
use Hyperf\Database\Model\Builder;
use Hyperf\DbConnection\Model\Model as BaseModel;

/**
 * @method static Builder filter(AbstractFilter $filters)
 */
abstract class AbstractModel extends BaseModel
{
    public function scopeFilter(Builder $builder, AbstractFilter $filter)
    {
        $filter->apply($builder);
    }

    public function anonymize(Generator $faker): self
    {
        return $this;
    }
}
