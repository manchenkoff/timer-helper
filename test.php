<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */


require 'vendor/autoload.php';

$time = "16:54:14";

var_dump(\Manchenkov\Timer\Timer::parseString($time));