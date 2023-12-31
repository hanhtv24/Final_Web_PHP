<?php ?>
<?php
/** @var $model app\models\Score */
/** @var View $this */

use app\core\form\TextareaField;
use app\core\View;
use \app\core\form\SelectionBoxField;

$this->title = 'Register Score';

?>
<h3>Create new Score</h3>
<?php $form = \app\core\form\Form::begin('', "post") ?>
<?php echo new SelectionBoxField($model, 'student_id', $model->selectionValue()['student_id']) ?>
<?php echo new SelectionBoxField($model, 'subject_id', $model->selectionValue()['subject_id']) ?>
<?php echo new SelectionBoxField($model, 'teacher_id', $model->selectionValue()['teacher_id']) ?>
<?php echo new SelectionBoxField($model, 'score', $model->selectionValue()['score']) ?>

<?php echo new TextareaField($model, 'description')?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end() ?>