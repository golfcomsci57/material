<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php'; ?>

<?php
if (!session_id()) @session_start();
$barcode = $_POST['barcode'];


$material = ORM::for_table('material')
    ->table_alias('m')
    ->select('m.*')
    ->select('t.name', 'type_name')
    ->select('u.name', 'unit_name')
    ->where('barcode', $barcode)
    ->join('material_type', array('m.type_id', '=', 't.id'), 't')
    ->join('unit', array('m.unit_id', '=', 'u.id'), 'u')
    ->find_one();


if (!isset($material)) {
    if (!session_id()) @session_start();
    $msg = new Plasticbrain\FlashMessages\FlashMessages();
    $msg->error('ไม่พบข้อมูล รหัส : ' . $barcode . ' ในระบบ.', 'index.php');
}

$stock = ORM::for_table('material_history')->find_one($material['id']);
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/head.php'; ?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-page"></i> รับวัสดุ
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">

            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form autocomplete="no" action="update.php" method="POST">
                <input type="hidden" name="material_id" value="<?= $material->id ?>">
                <div class="tile">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="data_div">
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>ชื่อวัสดุ :</strong>
                                        <span><?= $material->name ?></span> <span
                                                class="badge badge-info"><?= $material->amount; ?></span></li>
                                    <li class="list-group-item"><strong>รายละเอียด</strong>
                                        <p><?= $material['detail'] ?></p></li>
                                    <li class="list-group-item">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">จำนวน</span></div>
                                            <input class="form-control" type="number" name="amount">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><?= $material->unit_name ?></span>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                                <button class="btn btn-primary btn-block mt-4" type="Submit">
                                    บันทึกข้อมูล
                                </button>
            </form>
        </div>
</main>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'; ?>
