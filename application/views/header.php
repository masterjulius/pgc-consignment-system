<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$materialize_URL = base_url( '/materialize' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
<?php

	$link_font_awesome = array(
        'href'  => $materialize_URL . '/css/font-awesome.min.css',
        'rel'   => 'stylesheet',
        'type'  => 'text/css'
	);

	$link_material = array(
        'href'  => $materialize_URL . '/css/materialize.min.css',
        'rel'   => 'stylesheet',
        'type'  => 'text/css',
        'media' => 'screen,projection'
	);

    $fontello_style = array(
        'href'  => $materialize_URL . '/fontello/fontello.css',
        'rel'   => 'stylesheet',
        'type'  => 'text/css',
        'media' => 'screen,projection'
    );

	$link_main_style = array(
        'href'  => $materialize_URL . '/css/style.min.css',
        'rel'   => 'stylesheet',
        'type'  => 'text/css',
        'media' => 'screen,projection'
	);

	echo link_tag($link_font_awesome);
    echo link_tag($link_material);
	echo link_tag($fontello_style);
	echo link_tag($link_main_style);

	$meta = array(
        'name' 		=> 'viewport',
        'content' 	=> 'width=device-width, initial-scale=1.0'
    );
	echo meta($meta);
?>
	<title><?php echo $the_title = isset($page_title) ? $page_title : 'Consignment System'; ?></title>
</head>
<body class="<?php echo $this->page_actions->page_body_class(); ?>">