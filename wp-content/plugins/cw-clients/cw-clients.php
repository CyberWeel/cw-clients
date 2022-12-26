<?php
/**
* Plugin Name: CW Clients
* Version: 3.0
* Author: CyberWeel
* Author URI: https://github.com/CyberWeel/cw-clients
*/

require_once __DIR__.'/core/consts.php';
require_once CW_CLIENTS_CLASSES.'/CwClients.php';
require_once CW_CLIENTS_CORE.'/functions.php';
require_once CW_CLIENTS_CORE.'/shortcodes.php';

# После установки нужно:
# 1. Создать рубрику "Clients" со слагом "cw-clients". Поменять здесь значение константы CW_CLIENTS_ID на реальное значение ID свежесозданной рубрики
# 2. Создать по странице для формы и для каталога постов, на которых можно использовать шорткоды
# 3. После создания нового типа записи нужно зайти на страницу Настройки → Постоянные ссылки. Нужно это для того, чтобы правила ЧПУ были пересозданы и туда были добавлены правила нового типа записи.