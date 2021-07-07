<?php

namespace s2d;

require_once "./vendor/autoload.php";

use s2d\formater\mysql\V57Formater;

/*
* $formater = new V57Formater('[sql-input-path].sql');
* $formater->formatOutput('[md-output-path].md');
*/
$formater = new V57Formater('./sql/init.sql');
$formater->splitSections();
$formater->geneTables();
$formater->formatOutput('./md/init.md');
