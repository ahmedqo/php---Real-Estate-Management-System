<?php
session_start();
if(!isset($_SESSION["user"]))
{
    echo "-1";
}
else
{
    echo "1";
}
?>