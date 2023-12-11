<?php
function processElement($leTab, $path, $arg = "")
{
    foreach ($leTab as $key => $element) {
        if (gettype($element) != "array") {
            echo "<tr><td data-id='" . $path . "." . $key . "'>$key</td><td><textarea data-id='" . $path . "." . $key . "' onchange='sendData(this)' style='width:500px; height:125px' $arg>$element</textarea></td>";
        } else {
            echo "<tr><td><table>";
            $newPath = empty($path) ? $key : $path . "." . $key;
            processElement($element, $newPath, $arg);
            echo "</table></td></tr>";
        }
    }
}
?>