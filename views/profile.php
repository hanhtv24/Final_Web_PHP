<?php
use app\core\Application;

?>
<h1>Home</h1>
<h3>Welcome <?php if (!Application::isGuest()) { echo Application::$app->user->getDisplayName(); } ?> to Profile</h3>