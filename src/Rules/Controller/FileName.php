<?php

namespace LaravelRocket\Reviewer\Rules\Controller;

use LaravelRocket\Reviewer\Helpers\StringHelper;
use LaravelRocket\Reviewer\Result;

class FileName extends BaseControllerRule
{
    /**
     * @param $filePath
     *
     * @return array|\LaravelRocket\Reviewer\Result[]
     */
    protected function checkFile($filePath)
    {
        $results  = [];
        $pathInfo = pathinfo($filePath);
        if($pathInfo['filename'] !== 'Controller'
            && StringHelper::endsWith($pathInfo['filename'], 'Controller')) {
            $results[] = new Result(
                $filePath,
                0,
                Result::LEVEL_ERROR,
                self::class,
                'Controller should has "Controller" postfix',
                '',
                []
            );
        }

        return $results;
    }
}
