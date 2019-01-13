<?php

namespace LaravelRocket\Reviewer\Rules\Controller;

use LaravelRocket\Reviewer\Objects\ClassLike;
use LaravelRocket\Reviewer\Result;

class FatController extends BaseControllerRule
{
    /**
     * @param $filePath
     *
     * @return array|\LaravelRocket\Reviewer\Result[]
     */
    protected function checkFile($filePath)
    {
        $results = [];
        $class   = new ClassLike($filePath);
        $methods = $class->getMethods();
        if(count($methods) > 10) {
            $results[] = new Result(
                $filePath,
                0,
                Result::LEVEL_WARNING,
                self::class,
                'Too many methods in one controller',
                'Maximum 10 actions are allowed in one controller.',
                []
            );
        }

        foreach($methods as $method) {
            if(!$method->isPublic()) {
                $results[] = new Result(
                    $filePath,
                    $method->getLine(),
                    Result::LEVEL_ERROR,
                    self::class,
                    'Too many methods in one controller',
                    'Maximum 10 actions are allowed in one controller.',
                    []
                );
            }
            $startLine = $method->getStartLine();
            $endLine   = $method->getEndLine();

            $length = $endLine - $startLine;
            if($length > 20) {
                $results[] = new Result(
                    $filePath,
                    $method->getLine(),
                    Result::LEVEL_ERROR,
                    self::class,
                    'Too many lines in one action method',
                    $method->name . ' has ' . $length . ' lines. It is too long. Make it shorter than 20 lines',
                    []
                );
            }
        }

        return $results;
    }
}
