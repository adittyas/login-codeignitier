<?php
function flashMessage($msg, $type)
{
    $alert = "<a href='#' id='msg' data-msg='" . $msg . "' data-type='" . $type . "'></a>";
    return $alert;
}