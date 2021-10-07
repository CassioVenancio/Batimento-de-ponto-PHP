<?php

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

define('DAILY_TIME', 60 * 60 * 8);

define('MODEL_PATCH', realpath(dirname(__FILE__) . '/../models'));
define('VIEW_PATCH', realpath(dirname(__FILE__) . '/../views'));
define('CONTROLLER_PATCH', realpath(dirname(__FILE__) . '/../controllers'));
define('TEMPLATE_PATCH', realpath(dirname(__FILE__) . '/../views/template'));
define('EXCEPTION_PATCH', realpath(dirname(__FILE__) . '/../exceptions'));

require_once(realpath(dirname(__FILE__) . '/database.php'));
require_once(realpath(dirname(__FILE__) . '/loader.php'));
require_once(realpath(dirname(__FILE__) . '/session.php'));
require_once(realpath(dirname(__FILE__) . '/date_utils.php'));
require_once(realpath(dirname(__FILE__) . '/utils.php'));
require_once(realpath(MODEL_PATCH . '/Model.php'));
require_once(realpath(MODEL_PATCH . '/User.php'));
require_once(realpath(MODEL_PATCH . '/WorkingHours.php'));
require_once(realpath(EXCEPTION_PATCH . '/AppException.php'));
require_once(realpath(EXCEPTION_PATCH . '/ValidationException.php'));
