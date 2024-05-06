<?php
$toDoJson=file_get_contents("js/data.json");
// var_dump($toDoJson);

header("Content-Type: application/json");
echo $toDoJson;