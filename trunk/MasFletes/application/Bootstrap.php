<?php

class Bootstrap extends Model3_Site_Bootstrap
{

    public function _initBase()
    {
        error_reporting(E_ALL | E_STRICT);
        ini_set('display_errors', true);
        date_default_timezone_set('America/Mexico_City');
        session_start();
    }

    public function _initConstantes()
    {
        include('Config/constantes.php');
    }
    
    public function _initModules()
    {
        Model3_Site::registerModule('Admin');
        Model3_Site::registerModule('Customer');
        Model3_Site::registerModule('Agent');
        Model3_Site::registerModule('Ajax');
    }

}