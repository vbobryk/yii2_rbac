<?php


namespace RbacService\interfaces;


/**
 * Interface PermissionInterface
 * @package common\interfaces
 *
 * @property string $name
 * @property array $rule
 * @property PermissionInterface[] $childPermission
 */
interface PermissionInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return RuleInterface
     */
    public function getRule();

    /**
     * @param RuleInterface $rule
     */
    public function setRule(RuleInterface $rule);

    /**
     * @return PermissionInterface|null
     */
    public function getChildPermission(): ?PermissionInterface;

    /**
     * @param PermissionInterface $childPermission
     */
    public function setChildPermission(PermissionInterface $childPermission);


}