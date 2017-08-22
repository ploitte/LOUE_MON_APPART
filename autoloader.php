<?php

function loadMyClass($class){
    //Je vérifie que la classe n'a pas été déclarée

    if(class_exists($class) === false){
        //Si elle n'est pas déclarée je vérifie qu'elle existe bien dans le dossier "model"
        //à vous de changer ce dossier par le votre

        $string = 'models/'.$class.'.php';
        $string2 = 'services/'.$class.'.php';
        if(file_exists($string) === true){
            require $string;
        }
        if(file_exists($string2) === true){
            require $string2;
        }
    }
}
spl_autoload_register('loadMyClass');