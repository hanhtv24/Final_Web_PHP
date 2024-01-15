<?php
/** @var \app\models\forms\SearchFormScore $model  */
/** @var app\models\Score[] $items  */
/** @var View $this */

use app\core\form\SelectionBoxField;
use app\core\View;
use \app\models\Score;

$this->title = 'SEARCH SCORES';
?>
<h3>Search Scores</h3>
<?php $form = \app\core\form\Form::begin('', "post","searchForm") ?>

<?php echo new SelectionBoxField($model, 'student_id', Score::selectionValue()['student_id']) ?>
<?php echo new SelectionBoxField($model, 'subject_id', Score::selectionValue()['subject_id']) ?>
<?php echo new SelectionBoxField($model, 'teacher_id', Score::selectionValue()['teacher_id']) ?>

<input name="item_id" type="text" class="d-none">
    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
<?php \app\core\form\Form::end() ?>

<h5 class="mt-2">Số bản ghi tìm thấy: <?php echo count($items) ?></h5>
<table class="table mt-2">
    <thead>
    <tr>
        <th scope="col">NO</th>
        <th scope="col">Sinh viên</th>
        <th scope="col">Môn học</th>
        <th scope="col">Giáo viên</th>
        <th scope="col">Điểm</th>
        <th scope="col" colspan="2" class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $index => $item): ?>
        <tr>
            <th scope="row"><?php echo $index + 1?></th>
            <td class='d-none'><?php echo $item->id ?></td>
            <td class='student'><?php echo Score::selectionValue()['student_id'][$item->student_id] ?></td>
            <td><?php echo Score::selectionValue()['subject_id'][$item->subject_id] ?></td>
            <td><?php echo Score::selectionValue()['teacher_id'][$item->teacher_id] ?></td>
            <td><?php echo $item->score ?></td>
            <td class='text-end'><button class='btn btn-danger delete_btn'>Xóa</button></td>
            <td>
                <a href="/updateScore?id=<?php echo $item->id ?>" class='btn btn-info display_edit'>Sửa</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Xóa điểm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

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
        var studentName = $(this).closest("tr").find(".student").text();
        console.log("ID to be deleted: " + id);
        $("#delete").find(".modal-body").text("Bạn chắc chắn muốn xóa điểm của sinh viên " + studentName);
        $("#delete_popup").click();
        $("#delete_id").val(id);
    });

    $("#delete_item").on("click", () => {
        $('#searchForm').submit();
    });
</script>