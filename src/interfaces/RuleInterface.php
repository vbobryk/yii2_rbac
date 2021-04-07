<?php


namespace RbacService\interfaces;


interface RuleInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name);
}