<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/pdo.php';

use Dompdf\Dompdf;
use Jenssegers\Date\Date;

ob_start();
?>

<?php
session_start();
$report = ORM::for_table('report_no')->create();
$report->user_id = $_SESSION['user']['id'];
$report->save();

$sth = $pdo->query("SELECT 
    m.name material_name,
    t.name material_type,
    amount
    FROM material AS m
    LEFT JOIN material_type AS t ON m.type_id = t.id ORDER BY amount ASC");
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
    <!doctype html>
    <html lang="th">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="http://localhost/assets/report/report.css">
    </head>
    <body>
    <div class="sru-logo"></div>


    <p align="center"><img src="<?= $_SERVER['DOCUMENT_ROOT'] ?>/assets/report/img/SRU-Logo-Black-White.jpg"
                           class="sru-logo"></p>
    <p class="title">
        รายงานยอดคงเหลือวัสดุ
    </p>
    <div class="report-text-group">
        <p class="report-text-right">
            ออกรายงานเมื่อ : <?= Date::now()->add('543 years')->format('j F Y'); ?></p>
        <p class="report-text-right"> เลขที่ : <?= str_pad($report->id, 5, "0", STR_PAD_LEFT); ?></p>
    </div>

    <table>
        <tr>
            <th class="text-center">ชื่อวัสดุ</th>
            <th class="text-center">ประเภท</th>
            <th class="text-center">จำนวนคงเหลือ</th>
        </tr>
        <?php foreach ($result as $row => $link): ?>
            <tr>
                <td><?= $link['material_name'] ?></td>
                <td><?= $link['material_type'] ?></td>
                <td><?= $link['amount'] ?></td>

            </tr>
        <?php endforeach; ?>
    </table>

    </body>
    </html>

<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream();
