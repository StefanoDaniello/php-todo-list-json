<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- link css  -->
    <link rel="stylesheet" href="css/style.css">
    <!-- javascript  -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="js/script.js" defer type="module"></script>
    <title>Document</title>
    <div id="app" class="app">
        <header class="container my-2 d-flex flex-wrap justify-content-center">
            <input type="text" v-model="newTodo" class="form-control text-center w-75">
            <button class="btn btn-primary ms-2" @click="addItem">Aggiungi</button>
            
            <div class="d-flex align-items-center">
                <div class="search-container">
                    <input type="text" class="search-input form-control " placeholder="Cerca..." v-model="searchQuery" @input="findTask">
                    <i class="fas fa-search search-icon"></i>
                </div>  
                <select class="form-select w-25 p-3" name="done" id="done" v-model="done" >
                    <option value="">Filter</option>
                    <option value="completed">Completed</option>
                    <option value="notcompleted">Not completed</option>
                </select>
            </div> 
            
        </header>
        <main class="container">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between " v-for="(todo,index) in filteredTodo" :key="todo.id">
                    <span :class="{'text-decoration-line-through text-secondary' : todo.done}" role="button" @click="ToDoComplete(todo.id)">
                        {{todo.text}}
                    </span>
                    <i class="fa-solid fa-trash p-2" @click="removeItem(index)" role="button"></i>
                </li>
            </ul>
            
        </main>


    </div>
</head>
<body>
</body>
</html>