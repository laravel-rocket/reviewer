<?php
namespace LaravelRocket\Reviewer\Rules;

use LaravelRocket\Reviewer\Helpers\StringHelper;

class BaseRule
{
    /**
     * @return \LaravelRocket\Reviewer\Result[]
     */
    public function check()
    {
        return null;
    }

    protected function getAbsolutePath(string $relativePath)
    {
        return realpath("./".$relativePath);
    }

    protected function getPhpFiles(string $path)
    {
        if (!StringHelper::startsWith(DIRECTORY_SEPARATOR, $path)) {
            $path = $this->getAbsolutePath($path);
        }

        $phpFiles = [];

        $files = scandir($path);
        foreach ($files as $file) {
            if( $file === '.' || $file === '..') {
                continue;
            }
            $absolutePath = realpath($path.DIRECTORY_SEPARATOR.$file);
            if (is_dir($absolutePath)) {
                $phpFiles = array_merge($phpFiles, $this->getPhpFiles($absolutePath));
            } elseif (StringHelper::endsWith('.php', strtolower($file))) {
                $phpFiles[] = realpath($path.DIRECTORY_SEPARATOR.$file);
            }
        }

        return $phpFiles;
    }
}
