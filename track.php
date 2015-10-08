<?php
define('DBHOST', 'xxxxxx');
define('DBNAME', 'xxxxxx');
define('DBUSER', 'xxxxxx');
define('DBPASS', 'xxxxxx');

$nuukdb = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME . ';charset=utf8', DBUSER, DBPASS);
$nuukdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$nuukdb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$t_sep = '|';

$data = $_GET['data'];
$tracker = explode($t_sep, $data);

$nuuk = $nuukdb->prepare("INSERT INTO `wp_usage` (
    item_name,
    item_version,
    wp_version,
    wp_charset,
    wp_url,
    wp_ip,
    wp_email,
    wp_server,
    wp_php,
    wp_mysql,
    wp_memory,
    tracker_version,
    tracker_user_id
) VALUES (
    '$tracker[0]',
    '$tracker[1]',
    '$tracker[2]',
    '$tracker[3]',
    '$tracker[4]',
    '$tracker[5]',
    '$tracker[6]',
    '$tracker[7]',
    '$tracker[8]',
    '$tracker[9]',
    '$tracker[10]',
    '$tracker[11]',
    1
)");

$nuuk->execute();
?>
