<?php


namespace RbacService\permissions;


use RbacService\interfaces\PermissionInterface;
use RbacService\interfaces\RuleInterface;
use RbacService\rules\BaseRule;
use yii\rbac\Permission;

/**
 * Class BasePermission
 * @package common\permission
 */
abstract class BasePermission extends Permission implements PermissionInterface
{
    protected $childPermission;
    protected $rule;
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return BaseRule
     */
    public function getRule(): RuleInterface
    {
        return $this->rule;
    }

    /**
     * @param RuleInterface $rule
     */
    public function setRule(RuleInterface $rule)
    {
        $this->rule = $rule;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return BasePermission
     */
    public function getChildPermission(): ?PermissionInterface
    {
        return $this->childPermission;
    }

    /**
     * @param PermissionInterface $childPermission
     */
    public function setChildPermission(PermissionInterface $childPermission)
    {
        $this->childPermission = $childPermission;
    }
}