<?php

@session_start();

include_once('configs/base.inc.php');
include_once(LWAF_LIBROOT.'controller.php');

//run the app
new controller();

exit();

?>