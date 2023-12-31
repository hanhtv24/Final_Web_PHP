<?php
/** @var \app\models\forms\SearchFormTeacher $model  */
/** @var app\models\Teacher[] $items  */
/** @var View $this */

use app\core\form\SelectionBoxField;
use app\core\View;

$this->title = 'SEARCH TEACHERS';
?>
<h3>Search Teachers</h3>
<?php $form = \app\core\form\Form::begin('', "post","searchForm") ?>
<?php echo new SelectionBoxField($model, 'search_value', \app\models\Teacher::selectionValue()['specialized']) ?>
<?php echo $form->field($model, 'keyword_value') ?>
<input id="delete_id" name="delete_id" type="text" class="d-none">
    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
<?php \app\core\form\Form::end() ?>

<h5 class="mt-2">Số giáo viên tìm thấy: <?php echo count($items) ?></h5>
<table class="table mt-2">
    <thead>
    <tr>
        <th scope="col">NO</th>
        <th scope="col">Tên giáo viên</th>
        <th scope="col">Khoa</th>
        <th scope="col">Mô tả chi tiết</th>
        <th scope="col" colspan="2">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $index => $item): ?>
        <tr>
            <th scope="row"><?php echo $index + 1?></th>
            <td class='d-none'><?php echo $item->id ?></td>
            <td><?php echo $item->name ?></td>
            <td><?php echo \app\models\Teacher::selectionValue()['specialized'][$item->specialized] ?></td>
            <td><?php echo $item->description ?></td>
            <td class='text-end'><button class='btn btn-danger delete_btn'>Xóa</button></td>
            <td>
                <a href="/updateTeacher?id=<?php echo $item->id ?>" class='btn btn-info display_edit'>Sửa</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<button type="button" id="delete_popup" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#delete"></button>

<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa giáo viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn muốn xóa giáo viên này?
            </div>
            <div class="modal-footer">
                <button type="button" id="delete_item" class="btn btn-secondary" data-bs-dismiss="modal">Xóa</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.delete_btn', function() {
        var id = $(this).closest("tr").find(".d-none").text();
        console.log("ID to be deleted: " + id);
        $("#delete_popup").click();
        $("#delete_id").val(id);
    });

    $("#delete_item").on("click", () => {
        $('#searchForm').submit();
    });
</script>