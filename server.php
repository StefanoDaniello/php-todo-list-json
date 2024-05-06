<?php
$toDoJson=file_get_contents("js/data.json");
// var_dump($toDoJson);
$method = $_SERVER['REQUEST_METHOD'];
if($method === 'POST'){
    if(isset($_POST['id'])){
        var_dump($task);
        $task = json_decode($toDoJson,true);
        $taskphp =[
            'id' => (int) $_POST['id'],
            'text'=> $_POST['text'],
            'done'=>(bool)$_POST['done'] === false
        ];
        $task[]= $taskphp;
        $toDoJson = json_encode($task , JSON_PRETTY_PRINT);
        file_put_contents('js/data.json',$toDoJson);
    }
}elseif($method === 'DELETE'){
    $task = json_decode($toDoJson,true);
    $obj = json_decode(file_get_contents('php://input'), true);
    $index = $obj['id'];
    array_splice($task, $index, 1);
    $toDoJson = json_encode($task , JSON_PRETTY_PRINT);
    file_put_contents('js/data.json',$toDoJson);
}



header("Content-Type: application/json");
echo $toDoJson;                            