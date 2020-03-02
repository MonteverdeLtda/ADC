<?php 

$File = __FILE__;
$FileFolder = dirname(__FILE__);
$FolderBase = dirname(
	dirname(dirname(dirname(dirname((dirname(__FILE__) . '../') . '../') . '../') . '../') . '../')
);
define('PATH_SHORTLINK', $FolderBase . '/core/integrations/shortlink');

include_once($FolderBase . '/config/settings.php');
include_once($FolderBase . '/core/Conectar.php');
include_once($FolderBase . '/core/EntidadBase.php');
include_once($FolderBase . '/core/ModeloBase.php');
