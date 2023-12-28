<?php
use app\core\Application;
/** @var \app\core\View $this */
$this->title = 'Profile';
?>
<h1>Home</h1>
<h3>Welcome <?php if (!Application::isGuest()) { echo Application::$app->admin->getDisplayName(); } ?> to Profile</h3>