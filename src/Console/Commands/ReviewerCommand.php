<?php
namespace LaravelRocket\Reviewer\Console\Commands;

use LaravelRocket\Reviewer\Reviewer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ReviewerCommand extends BaseCommand
{
    protected $configFileName = '.laravel-rocket-reviewer';

    protected function configure()
    {
        $this->setName('review')->setDescription('Review Laravel Rocket Application.');
    }

    protected function getConfig()
    {
        $filename = getcwd().'/'.$this->configFileName;
        if (file_exists($filename)) {
            return json_decode(file_get_contents($filename), true);
        }

        return [];
    }

    protected function handle()
    {
        $reviewer = new Reviewer();
        $results  = $reviewer->execute();
        foreach ($results as $result) {
            $this->output($result->renderForTerminal());
        }
    }
}
