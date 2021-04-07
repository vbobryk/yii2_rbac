<?php


namespace RbacService\roles;


use RbacService\interfaces\RoleInterface;
use RbacService\permissions\BasePermission;
use yii\rbac\Role;

/**
 * Class BaseRole
 * @package common\roles
 *
 * @property array $permissions
 * @property array $childRoles
 */
abstract class BaseRole extends Role implements RoleInterface
{
    protected $permissions = [];
    protected $childRoles = [];

    /**
     * @param static[] $childRoles
     */
    public function setChildRoles(array $childRoles)
    {
        $this->childRoles = $childRoles;
    }

    /**
     * @return static[]
     */
    public function getChildRoles(): array
    {
        return $this->childRoles;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return BasePermission[]
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }


    /**
     * @param BasePermission[] $permissions
     */
    public function setPermissions(array $permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * Add permission to Role
     * @param $permissionName
     */
    protected function attachPermission(string $permissionName)
    {
        array_push($this->permissions, $permissionName);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}