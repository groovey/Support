<?php

require "vendor/autoload.php";

$rand = random_array(['one', 'two' , 'three']);

die(string_mask($rand));