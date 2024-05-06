<?php
$toDoJson=file_get_contents("js/data.json");
// var_dump($toDoJson);
if(isset($_POST['id'])){
    var_dump($task);
    $task = json_decode($toDoJson,true);
    $taskphp =[
        'id' => (int) $_POST['id'],
        'text'=> $_POST['text'],
        'done'=>$_POST['done'] === false
    ];
    $task[]= $taskphp;
    $toDoJson = json_encode($task , JSON_PRETTY_PRINT);
    file_put_contents('js/data.json',$toDoJson);
}


header("Content-Type: application/json");
echo $toDoJson;                            