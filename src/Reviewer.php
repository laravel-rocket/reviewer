<?php
namespace LaravelRocket\Reviewer;

class Reviewer
{
    protected $defaultRules = [
        \LaravelRocket\Reviewer\Rules\Controller\FileName::class,
        \LaravelRocket\Reviewer\Rules\Controller\FatController::class,
    ];

    /** @var string[] */
    protected $rules = [];

    public function __construct()
    {
        $this->rules = $this->defaultRules;
    }

    /**
     * @return array
     */
    public function getCurrentRules()
    {
        return $this->rules;
    }

    /**
     * @param string $className
     */
    public function addRule($className)
    {
        if (!in_array($className, $this->rules)) {
            $this->rules[] = $className;
        }
    }

    /**
     * @return array|\LaravelRocket\Reviewer\Result[]
     */
    public function execute()
    {
        $results = [];

        foreach ($this->rules as $rule) {
            /** @var \LaravelRocket\Reviewer\Rules\BaseRule $ruleInstance */
            $ruleInstance = new $rule();
            $result       = $ruleInstance->check();
            if (!empty($result)) {
                $results = array_merge($results, $result);
            }
        }

        return $results;
    }
}
