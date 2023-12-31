<?php ?>
<?php
/** @var $model app\models\Teacher */
/** @var View $this */

use app\core\form\TextareaField;
use app\core\View;
use \app\core\form\SelectionBoxField;

$this->title = 'Register Teacher';

?>
<h3>Create new teacher</h3>
<?php $form = \app\core\form\Form::begin('', "post") ?>
<?php echo $form->field($model, 'name') ?>
<?php echo new SelectionBoxField($model, 'specialized', $model->selectionValue()['specialized']) ?>
<?php echo new SelectionBoxField($model, 'degree', $model->selectionValue()['degree']) ?>
<?php echo new TextareaField($model, 'description')?>
<?php echo $form->field($model, 'avatar')->fileField() ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end() ?>