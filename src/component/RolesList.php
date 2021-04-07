<?php

namespace RbacService\component;

use RbacService\roles\BaseRole;
use yii\base\Component;

/**
 * Class RolesList
 * @package common\roles
 *
 * @property array $roles
 */
class RolesList extends Component
{
    public $roles;

    /**
     * @return array
     */
    public function getRolesList(): array
    {
        return $this->roles;
    }

    /**
     * @param BaseRole $role
     */
    public function addRole(BaseRole $role): void
    {
        array_push($this->roles, $role);
    }
}