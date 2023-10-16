<?php

namespace Ijdb;

use Ijdb\Controllers\Page;
use CSY2028\DatabaseTable;

class Routes implements \CSY2028\Routes
{
    public function getPage($route)
    {
        require '../database.php';
        $adminsTable = new DatabaseTable($pdo, 'user', 'userId');

        $controllers = [];
        $controllers['admin'] = new \Ijdb\Controllers\Admin($jobsTable, $categoriesTable, $applicantsTable, $adminsTable, $contactTable);


        if ($route == '') {
            $page = $controllers['admin']->home();
        }
        else {
            list($controllerName, $functionName) = explode('/', $route);
            $controller = $controllers[$controllerName];
            $page = $controller->$functionName();
        }
        return $page;
    }
}