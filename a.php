<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>
<?php
foreach($pdo->query("select * from data") as $row){
    print_r($row);
};
?>
<table class="table">
    <thead>
    <tr>
        <th>id</th>
        <th>site_id</th>
        <th>datetime</th>
        <th>url</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($datas as $data): ?>
        <tr>
            <td><?= $data['id'] ?></td>
            <td><?= $data['site_id'] ?></td>
            <td><?= $data['datetime'] ?></td>
            <td><?= $data['url'] ?></td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
</body>
</html>