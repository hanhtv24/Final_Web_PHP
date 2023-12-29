<?php ?>
<?php
/** @var $model app\models\Subject */
/** @var View $this */

use app\core\form\TextareaField;
use app\core\View;
use \app\core\form\SelectionBoxField;

$this->title = 'Register Subject';
?>
<h3>Create new subject</h3>
<?php $form = \app\core\form\Form::begin('', "post") ?>
<?php echo $form->field($model, 'name') ?>
<?php echo new SelectionBoxField($model, 'school_year', ['Năm 1', 'Năm 2', 'Năm 3', 'Năm 4']) ?>
<?php echo new TextareaField($model, 'description')?>
<?php echo $form->field($model, 'avatar')->fileField() ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end() ?>