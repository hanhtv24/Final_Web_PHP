<?php
/** @var app\models\Score $model */
/** @var string $forAction */
/** @var View $this */

use app\core\Application;
use app\core\form\TextareaField;
use app\core\View;
use \app\core\form\SelectionBoxField;
$this->title = 'Confirm Score';
?>
<h3>Confirm Score</h3>
<?php $form = \app\core\form\Form::begin('/confirmScore', "post", 'Form') ?>
<?php echo $form->field($model, 'student_id')->hiddenField()->noneLabelField() ?>
<?php echo $form->field($model, 'student_id', $model->selectionValue())->readOnlyField() ?>
<?php echo $form->field($model, 'subject_id')->hiddenField()->noneLabelField() ?>
<?php echo $form->field($model, 'subject_id', $model->selectionValue())->readOnlyField() ?>
<?php echo $form->field($model, 'teacher_id')->hiddenField()->noneLabelField() ?>
<?php echo $form->field($model, 'teacher_id', $model->selectionValue())->readOnlyField() ?>
<?php echo $form->field($model, 'score')->hiddenField()->noneLabelField() ?>
<?php echo $form->field($model, 'score', $model->selectionValue())->readOnlyField() ?>
<?php echo (new TextareaField($model, 'description'))->readOnlyField() ?>
<input type="hidden" name="edit" value="">
<div class="mt-3">
    <div id="edit" class="btn btn-primary">Sửa lại</div>
    <button type="submit" class="btn btn-primary">Nhập điểm</button>
</div>
<?php \app\core\form\Form::end() ?>

<script>
    $('#edit').click(function() {
        // Thay đổi action của form
        $('#Form').attr('action', '/registerScore');
        $('input[name="edit"]').val('true');
        $('#Form').submit();
    });
</script>
