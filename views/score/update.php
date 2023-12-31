<?php
/** @var $model app\models\Score */
/** @var $id string */
/** @var View $this */

use app\core\Application;
use app\core\form\TextareaField;
use app\core\View;
use \app\core\form\SelectionBoxField;

$this->title = 'Update Score';
?>
<h3>Update Score</h3>
<?php $form = \app\core\form\Form::begin('', "post") ?>
<?php echo new SelectionBoxField($model, 'student_id', $model->selectionValue()['student_id']) ?>
<?php echo new SelectionBoxField($model, 'subject_id', $model->selectionValue()['subject_id']) ?>
<?php echo new SelectionBoxField($model, 'teacher_id', $model->selectionValue()['teacher_id']) ?>
<?php echo new SelectionBoxField($model, 'score', $model->selectionValue()['score']) ?>
<?php echo (new TextareaField($model, 'description'))?>
<input type="hidden" name="edit" value="">
<input type="hidden" name="id" value="<?php echo ($id != '') ? $id : $model->id ?>">

<div class="mt-3">
    <button type="submit" class="btn btn-success">Xác nhận</button>
</div>
<?php \app\core\form\Form::end() ?>
