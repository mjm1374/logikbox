<?php if (!defined('WINPARENT')) { die('Permission Denied'); }?>
<!DOCTYPE html>
<html lang="<?php echo (isset($msw_html_lang) ? $msw_html_lang : 'en'); ?>" dir="<?php echo (isset($msw_html_dir) ? $msw_html_dir : 'ltr'); ?>">
	<head>
    <meta charset="<?php echo (isset($msw_html_charset) ? $msw_html_charset : 'utf-8'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $pageTitle; ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="templates/css/bootstrap.css" rel="stylesheet">
    <link href="templates/css/msw.css" rel="stylesheet">
    <link href="templates/css/jquery-ui.css" rel="stylesheet">

    <script src="templates/js/jquery.js"></script>
    <script src="templates/js/jquery-ui.js"></script>

    <link rel="icon" href="favicon.ico">
	</head>