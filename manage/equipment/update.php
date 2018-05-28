<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
$msg = new \Plasticbrain\FlashMessages\FlashMessages();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!session_id()) @session_start();
    if (isset($_FILES)) :
        $image = new Bulletproof\Image($_FILES);
        $image->setLocation($_SERVER['DOCUMENT_ROOT'] . '/uploads/equipment');
        if ($image["pictures"]) $upload = $image->upload();
        if (!$upload) $msg->error($image['error'], $_SERVER['HTTP_REFERER']);
    endif;

    $equipment = ORM::for_table('equipment')->find_one($_POST['id']);
    $equipment->barcode = $_POST['barcode'];
    $equipment->name = $_POST['name'];
    $equipment->barcode = $_POST['barcode'];
    $equipment->detail = $_POST['detail'];
    if ($upload) $equipment->image = $image->getName() . '.' . $image->getMime();
    $result = $equipment->save();

    if ($result):
        $msg->success('This is a success message', 'index.php');
    else:
        $msg->error('This is an error message', $_SERVER['HTTP_REFERER']);
    endif;

} else {
    $msg->error('This is an error message', 'index.php');
}

include $_SERVER['DOCUMENT_ROOT'] . '/include/foot.php';
