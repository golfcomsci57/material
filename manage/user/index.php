<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/head.php';
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> ข้อมูลผู้ใช้</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#">ข้อมูลผู้ใช้งาน</a></li>
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
                            <th class="text-center">#</th>
                            <th class="text-center">ชื่อ นามสกุล</th>
                            <th class="text-center">ที่อยู่</th>
                            <th class="text-center">โทรศัพท์</th>
                            <th class="text-center">ชื่อผู้ใช้</th>
                            <th class="text-center">ดำเนินการ</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $users = ORM::for_table('user')->find_many();
                        foreach ($users as $user) :?>

                            <tr class="<?= ($user['id']==1 ? 'text-danger':''); ?>">
                                <td><?= $user['id'] ?></td>
                                <td><?= $user['fullname'] ?></td>
                                <td><?= $user['address'] ?></td>
                                <td><?= $user['tel'] ?></td>
                                <td><?= $user['login'] ?></td>
                                <td>
                                    <button class="btn btn-info btn-sm edit" data-id="<?= $user['id'] ?>"><i
                                                class="fa fa-edit"></i> แก้ไข
                                    </button>
                                    <button class="btn btn-danger btn-sm delete" data-id="<?= $user['id'] ?>"
                                            data-name="<?= $user['name'] ?>"><i class="fa fa-trash"></i> ลบ
                                    </button>
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

    $("button.edit").click(function () {
        let id = $(this).data('id');
        window.location.href = 'edit.php?id=' + id;
    });

</script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/delete.php'; ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'; ?>



