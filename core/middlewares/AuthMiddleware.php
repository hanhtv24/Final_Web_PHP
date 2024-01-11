<?php

namespace app\core\middlewares;

use app\core\Application;
use app\core\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions = [];
    /**
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }
    public function execute()
    {
        if (Application::isGuest()) {
            // guest can't go any areas was initialized in actions
            if (in_array(Application::$app->controller->current_action, $this->actions)) {
                throw new ForbiddenException();
            }
        } else {
//            $role = Application::$app->admin->{'role'};
//            if ($role === '002') {
//                $actions = $this->actions;
//                $removeAction = array('/registerScore');
//                $actionsFinal = array_diff($actions, $removeAction);
//                if (in_array(Application::$app->request->getPath(), $actionsFinal)) {
//                    throw new ForbiddenException();
//                }
//            } elseif ($role === '003') {
//                if (in_array(Application::$app->request->getPath(), $this->actions)) {
//                    throw new ForbiddenException();
//                }
//            }
            $role = Application::$app->admin->{'role'};
            $path = Application::$app->request->getPath();

            $restrictedActions = [
                '002' => ['/registerScore'],
                '003' => [],
            ];

            if (isset($restrictedActions[$role])) {
                $actions = $this->actions;
                $restrictedActionsForRole = $restrictedActions[$role];

                if (in_array($path, array_diff($actions, $restrictedActionsForRole))) {
                    throw new ForbiddenException();
                }
            }

        }
    }
}