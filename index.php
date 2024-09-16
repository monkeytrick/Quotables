<?php

use Symfony\Component\DomCrawler\Crawler;

require 'functions.php';

if(isset($_GET['q']) && $_GET['q'] == 'challenge') {

    $get_quote = url_call('challenge', $_GET['p']);
}

else if(isset($_GET['img'])) {
    get_imgs($_GET['img']);
    // var_dump("function call params ar e", $_GET['img']);
    // var_dump($_GET['imgs']);
}

else {
    $persons = url_call('begin', null);    
}

