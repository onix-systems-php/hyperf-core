<?php
declare(strict_types=1);

namespace Hyperf\Core\Service\Common;

use Hyperf\Core\Model\AbstractModel;
use Hyperf\Core\Repository\AbstractRepository;
use Hyperf\Core\Service\Service;
use Faker\Factory;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\ContainerInterface;
use Hyperf\DbConnection\Annotation\Transactional;

#[Service]
class AnonymizeDataService
{
    public function __construct(
        private ConfigInterface $config,
        private ContainerInterface $container,
    ) {
    }

    #[Transactional(attempts: 1)]
    public function run(string $mode): void
    {
        $faker = Factory::create();

        $repositories = $this->config->get("anonymization.{$mode}", []);
        foreach ($repositories as $repositoryClassName => $methodName) {
            if (is_numeric($repositoryClassName)) {
                $repositoryClassName = $methodName;
                $methodName = 'anonymize';
            }

            $repositoryClass = $this->container->get($repositoryClassName);
            if (!$repositoryClass instanceof AbstractRepository) {
                continue;
            }

            $repositoryClass->chunk(100, function ($records) use ($faker, $methodName) {
                /** @var AbstractModel $record */
                foreach ($records as $record) {
                    $record->$methodName($faker)->saveOrFail();
                }
            });
        }
    }
}
