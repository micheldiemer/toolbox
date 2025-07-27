<?php

require_once __DIR__ . '/../vendor/autoload.php';
if($_SERVER['REQUEST_METHOD'] != 'GET') die();
if(empty($_GET['mdfile'])) die();
$mdfile = $_GET['mdfile'];

if(!file_exists($mdfile)) die();

die();

use FastVolt\Helper\Markdown;

$file_directory = __DIR__ . '/' . $mdfile;
# init markdown object
$mkd = Markdown::new();

 # set markdown file
$mkd->setFile( $file_directory );

 # convert to html
print $mkd->toHtml();

