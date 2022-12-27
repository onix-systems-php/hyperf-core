<?php

declare(strict_types=1);
namespace OnixSystemsPHP\HyperfCore\Command;

use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Contract\ConfigInterface;
use OpenApi\Analysers\TokenAnalyser;
use OpenApi\Generator;
use Symfony\Component\Console\Input\InputOption;


#[Command]
class SwaggerGenCommand extends HyperfCommand
{
    public function __construct(
        private ConfigInterface $config
    ) {
        parent::__construct('swagger:gen');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Generate swagger API doc');
    }

    public function handle()
    {
        $outputDir = $this->input->getOption('output');
        $format = $this->input->getOption('format');

        $paths = $this->config->get('swagger', ['app/']);
        $openapi = Generator::scan($paths, ['analyser' => new TokenAnalyser()]);

        if (strtolower($format) === 'json') {
            $content = $openapi->toJson();
        } else {
            $content = $openapi->toYaml();
        }
        $filename = $outputDir . 'openapi.' . $format;
        if (file_put_contents($filename, $content) === false) {
            throw new \Exception('Failed to saveAs("' . $filename . '", "' . $format . '")');
        }
        $this->info(sprintf('[INFO] Written to %s successfully.', $filename));
    }

    protected function getOptions(): array
    {
        return [
            ['output', 'o', InputOption::VALUE_OPTIONAL, 'Path to store the generated documentation.', './'],
            ['format', 'f', InputOption::VALUE_OPTIONAL, 'The format of the generated documentation, supports yaml and json.', 'yaml'],
        ];
    }
}
