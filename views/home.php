<?php
use app\core\Application;
/** @var \app\core\View $this */

$this->title='Home';
?>
<h1>Home</h1>
<div>
    <div class="container mt-3">
    <?php if (!Application::isGuest()): ?>
    <div>Tên login: <?php echo Application::$app->admin->getDisplayName() ?></div>
    <div>Thời gian login: <?php echo Application::$app->loginTime ?></div>
    <?php else: ?>
    <div>Welcome to Grade Management</div>
    <?php endif; ?>
        <div class="row mt-3">
            <div class="col-sm-2 m-2">
                <div class="">
                    Phòng học
                </div>
                <div class="list-group">
                    <a href="/" class="list-group-item list-group-item-action">Tìm kiếm</a>
                    <a href="/" class="list-group-item list-group-item-action">Thêm mới</a>
                </div>
            </div>
            <div class="col-sm-2 m-2">
                <div class="">
                    Giáo viên
                </div>
                <div class="list-group">
                    <a href="/" class="list-group-item list-group-item-action">Tìm kiếm</a>
                    <a href="/" class="list-group-item list-group-item-action">Thêm mới</a>
                </div>
            </div>
            <div class="col-sm-2 m-2">
                <div class="">
                    Môn học
                </div>
                <div class="list-group">
                    <a href="/" class="list-group-item list-group-item-action">Tìm kiếm</a>
                    <a href="/" class="list-group-item list-group-item-action">Thêm mới</a>
                </div>
            </div>
            <div class="col-sm-2 m-2">
                <div class="">
                    Sinh viên
                </div>
                <div class="list-group">
                    <a href="/" class="list-group-item list-group-item-action">Tìm kiếm</a>
                    <a href="/" class="list-group-item list-group-item-action">Thêm mới</a>
                </div>
            </div><div class="col-sm-2 m-2">
                <div class="">
                    Điểm
                </div>
                <div class="list-group">
                    <a href="/" class="list-group-item list-group-item-action">Tìm kiếm</a>
                    <a href="/" class="list-group-item list-group-item-action">Thêm mới</a>
                </div>
            </div>
        </div>
    </div>
</div>