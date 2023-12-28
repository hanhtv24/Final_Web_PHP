<?php
/** @var $model app\models\ResetRequestForm */
/** @var \app\core\View $this */
$this->title = 'Reset Request Password';
?>

<h1>Reset Request Password</h1>
<?php $form = \app\core\form\Form::begin('', "post") ?>
<?php echo $form->field($model, 'login_id') ?>
    <button type="submit" class="btn btn-primary">Send reset password request</button>
<?php \app\core\form\Form::end() ?>