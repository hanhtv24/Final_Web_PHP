<?php ?>
<?php
/** @var $model app\models\Student */
/** @var View $this */

use app\core\form\TextareaField;
use app\core\View;
use \app\core\form\SelectionBoxField;

$this->title = 'Register Student';
?>
<h3>Create new Student</h3>
<?php $form = \app\core\form\Form::begin('', "post") ?>
<?php echo $form->field($model, 'name') ?>
<?php echo new TextareaField($model, 'description')?>
<?php echo $form->field($model, 'avatar')->fileField() ?>
    <button type="submit" class="btn btn-primary">Xác nhận</button>
<?php \app\core\form\Form::end() ?>