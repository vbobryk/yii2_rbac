<?php


namespace RbacService\controllers;


use RbacService\component\RolesList;
use RbacService\interfaces\RoleInterface;
use RbacService\permissions\BasePermission;
use RbacService\roles\BaseRole;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;
use yii\rbac\ManagerInterface;

/**
 * @property ManagerInterface $authManager;
 */
class RbacController extends Controller
{
    private $authManager;

    public function init()
    {
        $this->setAuthManager(\Yii::$app->getAuthManager());
        parent::init();
    }

    /**
     * @throws \Exception
     */
    public function actionInitRoles()
    {
        /** @var RolesList $roles */
        $roles = \Yii::$app->get('roles');
        if (!empty($roles->getRolesList())) {
            foreach ($roles->getRolesList() as $roleClass) {
                /** @var BaseRole $role */
                $role = new $roleClass;
                $this->createRoleRecursive($role);
            }
        } else {
            Console::output('Roles list is empty');
        }
    }

    /**
     * @param $role
     * @throws \Exception
     */
    private function createRoleRecursive(BaseRole $role)
    {
        if (empty($this->getAuthManager()->getRole($role->getName()))) {
            $this->getAuthManager()->add($role);
        }
        $this->getAuthManager()->update($role->getName(), $role);
        /** @var BaseRole $role */
        if (!empty($role->getChildRoles())) {
            foreach ($role->getChildRoles() as $childRole) {
                $dbRoles = $this->getAuthManager()->getChildRoles($role->getName());
                $this->createRoleRecursive($childRole);
                if (!isset($dbRoles[$childRole->getName()])) {
                    $this->getAuthManager()->addChild($role, $childRole);
                }
            }
        }
        $dbPermissions = $this->getAuthManager()->getChildren($role->getName());
        if (!empty($role->getPermissions())) {
            foreach ($role->getPermissions() as $permission) {
                $this->createPermissionRecursive($permission);
                if (!isset($dbPermissions[$permission->getName()])) {
                    $this->getAuthManager()->addChild($role, $permission);
                }
            }
        }
        $this->removeObject(ArrayHelper::merge($role->getPermissions(), $role->getChildRoles()), $dbPermissions);
    }

    /**
     * @param BasePermission $permission
     * @throws \Exception
     */
    private function createPermissionRecursive(BasePermission $permission)
    {
        if (empty($this->getAuthManager()->getPermission($permission->getName()))) {
            $this->getAuthManager()->add($permission);
        }
        if (!empty($permission->getRule())) {
            if (empty($this->getAuthManager()->getRule($permission->getRule()->getName()))) {
                $this->getAuthManager()->add($permission->getRule());
            }
            $permission->ruleName = $permission->getRule()->getName();
        }
        $this->getAuthManager()->update($permission->getName(), $permission);
        $dbChildPermission = $this->getAuthManager()->getChildren($permission->getName());
        $this->removeObject([$permission->getChildPermission()], $dbChildPermission);
        if (!empty($permission->getChildPermission())) {
            $this->createPermissionRecursive($permission->getChildPermission());
            if (empty($dbChildPermission[$permission->getChildPermission()->getName()])) {
                $this->getAuthManager()->addChild($permission, $permission->getChildPermission());

            }
        }
    }

    /**
     * @param $localObjects
     * @param $dbObjects
     */
    private function removeObject(array $localObjects, array $dbObjects)
    {

        $removedObjects = array_diff(ArrayHelper::getColumn($dbObjects, 'name', false), ArrayHelper::getColumn($localObjects, 'name', false));
        foreach ($removedObjects as $removedObject) {
            $this->getAuthManager()->remove($dbObjects[$removedObject]);
        }
    }

    /**
     * @return ManagerInterface
     */
    public function getAuthManager(): ManagerInterface
    {
        return $this->authManager;
    }

    /**
     * @param ManagerInterface $authManager
     */
    public function setAuthManager(ManagerInterface $authManager)
    {
        $this->authManager = $authManager;
    }

}