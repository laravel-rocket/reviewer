<?php
namespace LaravelRocket\Reviewer\Rules\Controller;

use LaravelRocket\Reviewer\Rules\BaseRule;

class BaseControllerRule extends BaseRule
{
    public function getAllControllers()
    {
        return $this->getPhpFiles('app/Http/Controllers');
    }

    /**
     * @return array|\LaravelRocket\Reviewer\Result[]
     */
    public function check()
    {
        $results = [];
        $files   = $this->getAllControllers();
        foreach ($files as $filePath) {
            $result = $this->checkFile($filePath);
            if (!empty($result)) {
                $results = array_merge($results, $result);
            }
        }

        return $results;
    }

    /**
     * @param $filePath
     *
     * @return array|\LaravelRocket\Reviewer\Result[]
     */
    protected function checkFile($filePath)
    {
        $results = [];

        return $results;
    }
}
