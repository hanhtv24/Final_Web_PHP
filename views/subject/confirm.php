<?php
/** @var $model app\models\Subject */
/** @var View $this */

use app\core\Application;
use app\core\form\TextareaField;
use app\core\View;
use \app\core\form\SelectionBoxField;

$this->title = 'Confirm Subject';
?>
<h3>Confirm Subject</h3>
<?php $form = \app\core\form\Form::begin('/confirmSubject', "post", 'subjectForm') ?>
<?php echo $form->field($model, 'name')->readOnlyField() ?>
<?php echo $form->field($model, 'school_year')->readOnlyField() ?>
<?php echo (new TextareaField($model, 'description'))->readOnlyField() ?>
<?php echo $form->field($model, 'avatar')->hiddenField() ?>
<input type="hidden" name="edit" value="">
<div>
    <img src="../web/avatar/<?php echo $model->avatar?>" class="img-fluid" alt="Avatar Image" style="width: 300px; height: auto">
</div>
<div class="mt-3">
    <div id="edit" class="btn btn-primary">Sửa lại</div>
    <button type="submit" class="btn btn-success">Đăng ký</button>
</div>
<?php \app\core\form\Form::end() ?>

<script>
    $('#edit').click(function() {
        // Thay đổi action của form
        $('#subjectForm').attr('action', '/registerSubject');
        $('input[name="edit"]').val('true');
        $('#subjectForm').submit();
    });
</script>
