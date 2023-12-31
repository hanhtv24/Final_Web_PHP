<?php
/** @var app\models\Student $model */
/** @var string $id */
/** @var View $this */

use app\core\Application;
use app\core\form\TextareaField;
use app\core\View;

$this->title = 'Confirm Edit Student';
?>

<h3>Confirm Edit Subject</h3>
<?php $form = \app\core\form\Form::begin('/confirmEditStudent', "post", 'Form') ?>
<?php echo $form->field($model, 'name')->readOnlyField() ?>
<?php echo (new TextareaField($model, 'description'))->readOnlyField() ?>
<?php echo $form->field($model, 'avatar')->hiddenField() ?>
<input type="hidden" name="edit" value="">
<input type="hidden" name="id" value="<?php echo $id ?>">

<div>
    <img src="../web/avatar/<?php echo $model->avatar?>" class="img-fluid" alt="Avatar Image" style="width: 300px; height: auto">
</div>
<div class="mt-3">
    <div id="edit" class="btn btn-primary">Sửa lại</div>
    <button type="submit" class="btn btn-success">Sửa</button>
</div>
<?php \app\core\form\Form::end() ?>

<script>
    $('#edit').click(function() {
        // Thay đổi action của form
        $('#Form').attr('action', '/updateStudent');
        $('input[name="edit"]').val('true');
        $('#Form').submit();
    });
</script>
