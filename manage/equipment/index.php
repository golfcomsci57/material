<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/head.php';
?>


<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> ข้อมูลอุปกรณ์</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active"><a href="#">Data Table</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col">
            <?php get_message(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th class="text-center">บาร์โค้ด</th>
                            <th class="text-center">ชื่ออุปกรณ์</th>
                            <th class="text-center">รายละเอียด</th>
                            <th class="text-center">ดำเนินการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $equipments = ORM::for_table('equipment')->find_many();
                        foreach ($equipments as $equipment): ?>
                            <tr>
                                <td>
                                    <?php
                                    switch ($equipment['no_barcode']) {
                                        case 0:
                                            echo $equipment['barcode'];
                                            break;
                                        case 1:
                                            echo '<a href="/barcode-master/barcode.php?f=png&s=upc-a&d=' . $equipment['barcode'] . '"
                                           class="text-info">' . $equipment['barcode'] . '</a>';
                                            break;
                                    }
                                    ?>

                                </td>
                                <td><?= $equipment['name'] ?></td>
                                <td><?= $equipment['detail'] ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button href="#imageUrl" data-id="/uploads/equipment/<?= $equipment['image'] ?>"
                                                data-detail="<?= $equipment['detail'] ?>"
                                                class="btn btn-info openModalDetail thumbnail" data-toggle="modal"><i
                                                    class="fa fa-info"></i> ข้อมูล
                                        </button>

                                        <button type="button" onclick="edit(<?= $equipment['id'] ?>)"
                                                class="btn btn-primary edit"><i class="fa fa-pencil-square-o"></i> แก้ไข
                                        </button>
                                        <button class="btn btn-danger btn-sm delete"
                                                data-id="<?= $equipment['id'] ?>"
                                                data-name="<?= $equipment['name'] ?>"><i class="fa fa-trash"></i>ลบ
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="imageUrl" tabindex="-1" role="dialog" aria-labelledby="imageUrlLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">รายละเอียดอุปกรณ์</h4>
            </div>
            <div class="modal-body">
                <img id="img" width="250px" class="img-responsive" src="" alt="">
                <p class="detail" id="detail"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger center-block" data-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'; ?>
<script type="text/javascript">


    $(document).ready(function () {
        var table = $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Thai.json"
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'เพิ่มรายการใหม่',
                    className: "btn btn-primary",
                    action: function () {
                        window.location.href = "create.php";
                    }
                }
            ],

        });
    });


    $(document).on("click", ".openModalDetail", function () {
        var imageId = $(this).data('id');
        var detail = $(this).data('detail');
        document.getElementById("detail").innerHTML = detail;
        $(".modal-body #img").attr("src", imageId);

    });

    function edit(id) {
        window.location.href = 'edit.php?id=' + id;
    }


</script>

<script>
    function edit(id) {
        window.location.href = 'edit.php?id=' + id;
    }
</script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/delete.php'; ?>
