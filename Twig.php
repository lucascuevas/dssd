<?php
require_once './vendor/autoload.php';

class TwigController {
    
   
    private static $twig;


    public static function getTwig() {

        if (!isset(self::$twig)) {

            Twig_Autoloader::register();
            $loader = new Twig_Loader_Filesystem('views');
            self::$twig = new Twig_Environment($loader);
        }
        return self::$twig;
    }

    private function __construct() {
        
    }    

    public static function render_view($page,$datos){
            
        echo self::getTwig()->render($page,
            ['files' => $datos[0],
                    'token'=> $datos[1]]);
    }
    public static function render_index($page){

        echo self::getTwig()->render($page,array());
    
    }
    
}