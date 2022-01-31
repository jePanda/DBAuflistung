<?php
function ToHtmlValue($arr, $name)
{
    echo htmlspecialchars(isset($arr[$name]) ? $arr[$name] : "");
}

?>