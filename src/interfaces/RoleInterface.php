<?php


namespace RbacService\interfaces;


/**
 * Class RoleInterface
 * @package common\interfaces
 *
 * @property $name
 * @property PermissionInterface[] $permissions
 * @property RoleInterface[] $childRoles
 */
interface RoleInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param  string
     */
    public function setName(string $name);

    /**
     * @return PermissionInterface[]
     */
    public function getPermissions(): array;

    /**
     * @param PermissionInterface[] $permissions
     */
    public function setPermissions(array $permissions);

    /**
     * @return RoleInterface[]
     */
    public function getChildRoles(): array;

    /**
     * @param RoleInterface[] $childRoles
     */
    public function setChildRoles(array $childRoles);

    /**
     * @param string $description
     */
    public function setDescription(string $description);

    /**
     * @return string
     */
    public function getDescription(): string ;

}