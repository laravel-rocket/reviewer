<?php

namespace LaravelRocket\Reviewer;

class Result
{
    /** @var string */
    protected $path;

    /** @var int */
    protected $line;

    /** @var string */
    protected $level;

    /** @var string */
    protected $rule;

    /** @var string */
    protected $title;

    /** @var string */
    protected $message;

    /** @var array */
    protected $data;

    const LEVEL_INFO    = 'info';
    const LEVEL_WARNING = 'warning';
    const LEVEL_ERROR   = 'error';

    public function __construct(
        string $path,
        int $line,
        string $level,
        string $rule,
        string $title,
        string $message,
        array $data
    )
    {
        $this->path    = $path;
        $this->line    = $line;
        $this->level   = $level;
        $this->rule    = $rule;
        $this->title   = $title;
        $this->message = $message;
        $this->data    = $data;
    }

    protected function getColor()
    {
        switch($this->level) {
            case self::LEVEL_INFO:
                return 'info';
            case self::LEVEL_WARNING:
                return 'warning';
            case self::LEVEL_ERROR:
                return 'error';
        }

        return 'green';
    }

    /**
     * @return string
     */
    public function renderForTerminal()
    {
        $color  = $this->getColor();
        $string = "<$color>$this->title</$color>" . PHP_EOL;
        if(!empty($this->message)) {
            $string .= "   " . $this->message . PHP_EOL;
        }
        $string .= "   Position: $this->path ( $this->line )" . PHP_EOL;

        return $string;
    }
}
