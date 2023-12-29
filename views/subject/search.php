<?php
/** @var app\models\SearchFormSubject $model  */
/** @var app\models\Subject[] $items  */
/** @var View $this */

use app\core\Application;
use app\core\form\TextareaField;
use app\core\View;
use \app\core\form\SelectionBoxField;

$this->title = 'SEARCH SUBJECTS';
?>
<h3>Search Subject</h3>
<?php $form = \app\core\form\Form::begin('', "post") ?>
<?php echo new SelectionBoxField($model, 'search_value', ['Năm 1', 'Năm 2', 'Năm 3', 'Năm 4']) ?>
<?php echo $form->field($model, 'keyword_value') ?>
    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
<?php \app\core\form\Form::end() ?>

<h5 class="mt-2">Số môn học tìm thấy: <?php echo count($items) ?></h5>
<table class="table mt-2">
    <thead>
    <tr>
        <th scope="col">NO</th>
        <th scope="col">Tên môn học</th>
        <th scope="col">Khóa học</th>
        <th scope="col">Mô tả chi tiết</th>
        <th scope="col">Action</th>

    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $index => $item): ?>
<!--        --><?php //$form = \app\core\form\Form::begin('', "post") ?>
<!--        --><?php //echo "<input type='hidden' name='login_id' value='$admin->login_id'>" ?>
        <tr>
            <th scope="row"><?php echo $index + 1?></th>
<!--            <td>--><?php //echo $admin->login_id ?><!--</td>-->
<!--            --><?php //if ($admin->login_id != $model->login_id) {
//                $model->errors = [];
//                $model->password = '';
//            } else {
//                $model->errors = $errors;
//                $model->password = $password;
//            }?>
            <td><?php echo $item->name ?></td>
            <td><?php echo $item->school_year ?></td>
            <td><?php echo $item->description ?></td>
            <td>Xóa | Sửa</td>
<!--            <td>--><?php //echo new InputNoneLabelField($model, 'password') ?><!--</td>-->
<!--            <td><button type="submit" class="btn btn-primary">Submit</button></td>-->
        </tr>
<!--        --><?php //\app\core\form\Form::end() ?>
    <?php endforeach; ?>
    </tbody>
</table>
