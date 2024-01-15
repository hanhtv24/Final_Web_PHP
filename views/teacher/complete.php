<?php
/** @var $model app\models\Teacher */
/** @var View $this */

use app\core\Application;
use app\core\form\TextareaField;
use app\core\View;
use \app\core\form\SelectionBoxField;
$this->title = 'Complete Teacher';

?>
<h3>Complete Teacher</h3>
<?php if (isset($method) && $method === 'edit'): ?>
    <h5>Bạn đã sửa thành công cho giáo viên <?php echo $model->name ?></h5>
<?php else: ?>
    <h5>Bạn đã đăng ký thành công cho giáo viên <?php echo $model->name ?></h5>
<?php endif; ?>
<a href="/">Trở về trang chủ</a>