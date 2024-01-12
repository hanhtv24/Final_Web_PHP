<?php
/** @var View $this */
/** @var $model */


use app\core\Application;
use app\core\form\TextareaField;
use app\core\View;
use \app\core\form\SelectionBoxField;
use app\models\Student;

$this->title = 'Complete Scores';
$name = Student::findOne(['id' => $model->student_id])->name;
?>
<h3>Complete Score</h3>
<?php if (isset($method) && $method === 'edit'): ?>
<h5>Bạn đã sửa điểm thành công cho sinh viên <?php echo $name ?></h5>
<?php else: ?>
<h5>Bạn đã nhập điểm thành công cho sinh viên <?php echo $name ?></h5>
<?php endif; ?>
<a href="/">Trở về trang chủ</a>