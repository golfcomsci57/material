<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
$msg = new \Plasticbrain\FlashMessages\FlashMessages();

if ($_SERVER['REQUEST_METHOD'] === 'POST'):
    $material_type = ORM::for_table('material_type')->find_one($_POST['id']);
    $material_type->name = $_POST['name'];
    $result = $material_type->save();

    if ($result):
        $msg->success('แก้เสร็จ', 'index.php');
    else:
        $msg->error('พบข้อผิดพลาด', $_SERVER['HTTP_REFERER']);
    endif;

else:
    $msg->error('พบข้อผิิดพลาด', 'index.php');
endif;

include $_SERVER['DOCUMENT_ROOT'] . '/include/foot.php';
