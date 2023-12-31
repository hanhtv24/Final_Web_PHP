<?php

use app\core\form\InputNoneLabelField;

/** @var \app\models\forms\ResetForm $model  */
/** @var \app\models\Admin[] $admins */
/** @var \app\core\View $this */
$this->title = 'Reset';
$errors = $model->errors;
$password = $model->password;
?>
<h1>Reset</h1>
<table class="table">
    <thead>
    <tr>
        <th scope="col">NO</th>
        <th scope="col">Tên người dùng</th>
        <th scope="col">Mật khẩu mới</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($admins as $index => $admin): ?>
        <?php $form = \app\core\form\Form::begin('', "post") ?>
        <?php echo "<input type='hidden' name='login_id' value='$admin->login_id'>" ?>
        <tr>
            <th scope="row"><?php echo $index + 1?></th>
            <td><?php echo $admin->login_id ?></td>
            <?php if ($admin->login_id != $model->login_id) {
                    $model->errors = [];
                    $model->password = '';
            } else {
                $model->errors = $errors;
                $model->password = $password;
            }?>
            <td><?php echo new InputNoneLabelField($model, 'password') ?></td>
            <td><button type="submit" class="btn btn-primary">Submit</button></td>
        </tr>
        <?php \app\core\form\Form::end() ?>
        <?php endforeach; ?>
    </tbody>
</table>

<script>

</script>
