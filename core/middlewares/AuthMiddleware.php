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
        }
    }
}