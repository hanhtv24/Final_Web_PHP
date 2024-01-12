<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\helpers\UploadHelper;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;

class MainController extends Controller
{
    public $classItemName;
    public $classSearchName;
    
    public function __construct($classItemName, $classSearchName)
    {
        // Initial restricted areas
        $this->registerMiddleware(new AuthMiddleware(['register', 'confirm', 'complete', 'search']));
        $this->classItemName = $classItemName;
        $this->classSearchName = $classSearchName;
    }

    public function register(Request $request, Response $response)
    {
        $item = new $this->classItemName();
        if ($request->isPost()) {
            $item->loadData($request->getBody());
            $edit = $request->getBody()['edit'] ?? '';
            var_dump($edit);
            if ($edit === '') {
                if (property_exists($item, 'avatar')) {
                    UploadHelper::uploadFile($item, $item->upload_attributes(), Application::$ROOT_DIR . '/public/web/avatar', $request);
                    if ($item->validate()) {
                        $item->avatar = basename($item->avatar);
                        return $this->render('confirm', ['model' => $item]);
                    }
                } else {
                    if ($item->validate()) {
                        return $this->render('confirm', ['model' => $item]);
                    }
                }

            }
            return $this->render('register', ['model' => $item]);
        }
        return $this->render('register', ['model' => $item]);
    }

    public function confirm(Request $request, Response $response)
    {
        $item = new $this->classItemName();
        if ($request->isPost()) {
            $item->loadData($request->getBody());
            $edit = $request->getBody()['edit'];
            if ($edit != 'true') {
                if ($item->validate() && $item->save())
                {
                    return $this->render('complete', ['model' => $item]);
                }
            }
            $response->redirect('/register'.get_class($this->classItemName));
        }
        $response->redirect('/register'.get_class($this->classItemName));
        exit;
    }

    public function search(Request $request, Response $response)
    {
        $itemForm = new $this->classSearchName();
        if ($request->isPost()) {
            if ($request->getBody()['delete_id'] != '') {
                $this->classItemName::delete(['id' => $request->getBody()['delete_id']]);
            }
            $itemForm->loadData($request->getBody());
            $items = $itemForm->search($itemForm->getNameSearchKey(), $itemForm->getSearchValue());
            return $this->render('search', ['model' => $itemForm, 'items' => $items]);
        }
        return $this->render('search', ['model' => $itemForm, 'items' => []]);
    }

    public function update(Request $request, Response $response)
    {
        $item = new $this->classItemName();
        if ($request->isPost()) {
            $item->loadData($request->getBody());
            $edit = $request->getBody()['edit'] ?? '';
            if ($edit === '') {
                if (property_exists($item, 'avatar')) {
                    if ($request->getFile('avatar')['name'] != '') {
                        UploadHelper::uploadFile($item, 'avatar', Application::$ROOT_DIR . '/public/web/avatar', $request);
                        $item->avatar = basename($item->avatar);
                        if (!$item->validate()) {
                            return $this->render('update', ['model' => $item]);
                        }
                        return $this->render('confirmEdit', ['model' => $item, 'id' => $request->getBody()['id']]);
                    }
                    $item->avatar = ($request->getBody())['old_avatar'];
                }
                if ($item->validate()) {
                    return $this->render('confirmEdit', ['model' => $item, 'id' => $request->getBody()['id']]);
                }
            }
            return $this->render('update', ['model' => $item, 'id' => $request->getBody()['id']]);
        }
        $item = $this->classItemName::findOne(['id' => ($request->getBody())['id']]);
        return $this->render('update', ['model' => $item, 'id' => '']);
    }

    public function confirmEdit(Request $request, Response $response)
    {
        $item = new $this->classItemName();
        if ($request->isPost()) {
            $item->loadData($request->getBody());
            $edit = $request->getBody()['edit'];
            if ($edit === '') {
                if ($item->validate() && $item->update($item->attributes(), ['id' => $request->getBody()['id']]))
                {
                    return $this->render('complete', ['model' => $item, 'method' => 'edit']);
                }
            }
            $response->redirect('/search');
        }
        $response->redirect('/search');
        exit;
    }
}