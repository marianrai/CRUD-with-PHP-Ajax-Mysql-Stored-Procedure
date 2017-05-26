<?php

spl_autoload_register(function ($class) {
    
    $fullClassName = 'classes/'. $class .'.php';
    
    if (file_exists($fullClassName)) {
        require_once $fullClassName;
    } else {
        echo '
            <h1>There is a problem with the app.</h1>
            <p>The required class <b>'. $class .'</b> could not be loaded.</p>
        ';
        die();
    }

});