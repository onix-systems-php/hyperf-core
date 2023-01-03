<?php

declare(strict_types=1);
namespace OnixSystemsPHP\HyperfCore\Model;

use Faker\Generator;
use Hyperf\Database\Model\Builder as BaseBuilder;
use Hyperf\DbConnection\Model\Model as BaseModel;
use OnixSystemsPHP\HyperfCore\Model\Filter\AbstractFilter;

/**
 * @method static BaseBuilder filter(AbstractFilter $filters)
 * @method static Builder query()
 */
abstract class AbstractModel extends BaseModel
{
    public function scopeFilter(BaseBuilder $builder, AbstractFilter $filter)
    {
        $filter->apply($builder);
    }

    public function newModelBuilder($query): Builder
    {
        return new Builder($query);
    }

    public function anonymize(Generator $faker): self
    {
        return $this;
    }
}
