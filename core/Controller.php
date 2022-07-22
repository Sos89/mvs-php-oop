<?php
/**
 * @var \app\core\middlewares\BaseMiddleware[]
 */
namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = 'main';
    public string $action = '';


    protected array $middleware = [];
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middleware[] = $middleware;
    }

    /**
     * @return BaseMiddleware[]
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }


}