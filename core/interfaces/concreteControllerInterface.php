<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 4:50 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface concreteControllerInterface
    extends basicControllerInterface
{
    public function checkAction();
    public function handleAction();
    public function sendErrors();
}