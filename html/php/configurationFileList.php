<?php
/**
 * PHP Version 5.5.3-1ubuntu2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 12/10/13
 * Time: 6:15 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_CORE."FileList.php";
$fl = FileList::instance("config.inc.php");
$fl->setLocation(AMPHIBIAN_CONFIG);
$fl->execute();
$fl->printSelectList('configurationList','configurationList',null,array("config.inc.php"));
echo $fl->html;