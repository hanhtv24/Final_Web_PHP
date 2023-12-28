<?php
/** @var $model app\models\ContactForm */
/** @var \app\core\View $this */

use app\core\form\TextareaField;

$this->title = 'Contact';
?>
<h1>Contact</h1>
<?php $form = \app\core\form\Form::begin('', 'post') ?>
<?php echo $form->field($model, 'subject') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo new TextareaField($model, 'addInformation')?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end(); ?>