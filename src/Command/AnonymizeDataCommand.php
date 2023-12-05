<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Command;

use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use OnixSystemsPHP\HyperfCore\Service\Common\AnonymizeDataService;
use Symfony\Component\Console\Input\InputArgument;

#[Command]
class AnonymizeDataCommand extends HyperfCommand
{
    public function __construct(
        private AnonymizeDataService $anonymizeDataService
    ) {
        parent::__construct('seed:anonymize');
    }

    public function configure(): void
    {
        parent::configure();
        $this->setDescription('Anonymize sensitive data');
    }

    public function handle(): void
    {
        $mode = $this->input->getArgument('mode');
        if (empty($mode)) {
            $mode = 'main';
        }
        $this->anonymizeDataService->run($mode);
        $this->line('Success');
    }

    protected function getArguments(): array
    {
        return [
            ['mode', InputArgument::OPTIONAL, 'Anonymization mode'],
        ];
    }
}
