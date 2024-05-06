<?php
$toDoJson=file_get_contents("js/data.json");
// var_dump($toDoJson);
$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'GET') {
    $task = json_decode($toDoJson,true);
    if($method === 'POST'){
        if(isset($_POST['id'])){
            $taskphp =[
                'id' => (int) $_POST['id'],
                'text'=> $_POST['text'],
                'done'=>(bool)$_POST['done'] === false
            ];
            $task[]= $taskphp;
        }
    }elseif($method === 'DELETE'){
        $task = json_decode($toDoJson,true);
        $obj = json_decode(file_get_contents('php://input'), true);
        $index = $obj['id'];
        array_splice($task, $index, 1);
    }elseif($method === 'PUT'){
        $task = json_decode($toDoJson,true);
        $obj = json_decode(file_get_contents('php://input'), true);
        $index = $obj['idx'];
        $task[$index]['done'] = !$task[$index]['done'];
    }
    $toDoJson = json_encode($task , JSON_PRETTY_PRINT);
    file_put_contents('js/data.json',$toDoJson);
};

header("Content-Type: application/json");
echo $toDoJson;                            