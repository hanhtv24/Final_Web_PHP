<?php

namespace app\core;

class View
{
    public string $title = '';
    public function renderView(string $view, $params = [])
    {
        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    public function renderContent(string $viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if (Application::$app->controller) {
            $layout = Application::$app->controller->layout;
        }
        // Tạo bộ đệm để return string html thay vì trả ra Browers content
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }
    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            // Tạo biến với tên là giá trị của $key và giá trị là $value
            $$key = $value;
        }
        $contentView = Application::$app->controller->contentView;
        // Tạo bộ đệm để return string html thay vì trả ra Browers content
        ob_start();
        if ($contentView === '') {
            include_once Application::$ROOT_DIR."/views/$view.php";
        } else {
            include_once Application::$ROOT_DIR."/views/$contentView/$view.php";
        }
        return ob_get_clean();
    }
}