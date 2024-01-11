<?php
/** @var $model app\models\User */
/** @var \app\core\View $this */

use app\core\form\SelectionBoxField;

$this->title = 'Register';
?>
<h1>Create an account</h1>
<?php $form = \app\core\form\Form::begin('', "post") ?>
    <?php echo $form->field($model, 'name') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo new SelectionBoxField($model, 'role', $model->selectionValue()['role']) ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end() ?>