<?php
/** @var $model app\models\LoginForm */
/** @var \app\core\View $this */
$this->title = 'Login';
?>

<h1>Login</h1>
<?php $form = \app\core\form\Form::begin('', "post") ?>
    <?php echo $form->field($model, 'login_id') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <a class="btn btn-success active" href="/resetRequest">Forgot password</a>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end() ?>