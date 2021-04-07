Usage
-------

Add service to components:

```php
'roles' => [
         'class' => \RbacService\component\RolesList::class,
         'roles' => [
             \app\roles\AdminRole::class, <- Role extended by \RbacService\roles\BaseRole
         ],
     ],
```
-------
```php
<?php
/**
 * Created by PhpStorm.
 * User: vladimir-bobrik
 * Date: 29.05.18
 * Time: 22:07
 */
namespace app\roles;

use RbacService\roles\BaseRole;

/**
 * Class AdminRole
 * @package app\roles
 */
class AdminRole extends BaseRole
{
    /**
     * Role name
     */
    const ROLE_NAME = 'admin';

    public $name = self::ROLE_NAME;

    /**
     * Init Admin permissions
     */
    protected function initPermission()
    {
    }
}
```

