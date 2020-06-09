<?php
//define const
define("DS",DIRECTORY_SEPARATOR); //dynamic separator
define("ROOT_PATH",getcwd().DS); //dir mantenant
define("APP_PATH",ROOT_PATH."Admin".DS); //Admin dir

//include frame class
require_once(ROOT_PATH."Frame".DS."Frame.class.php");
//manupuler run function
Frame\Frame::run();