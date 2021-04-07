<?php

namespace RbacService\rules;


use RbacService\interfaces\RuleInterface;
use yii\rbac\Rule;

abstract class BaseRule extends Rule implements RuleInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
}