
const { createApp } = Vue;

createApp({
    data() {
        return {
            originalTodo: [],
            todo: [],
            newTodo: '',
            searchQuery: '',
            done: '',
            apiUrl:'server.php',
        }
    },
    methods: {
        getData() {
            axios.get(this.apiUrl).then((res)=>{
                this.originalTodo = res.data;
                this.todo = res.data;
                console.log(this.originalTodo);
            })
        },
        ToDoComplete(id) {
            const task = this.originalTodo.find(task => task.id === id);
            task.done = !task.done;
        },
        removeItem(id) {
            const index = this.originalTodo.findIndex(task => task.id === id);
            if (index !== -1) {
                this.originalTodo.splice(index, 1);
                // Effettua la stessa operazione sulla lista originale
                const originalIndex = this.originalTodo.findIndex(task => task.id === id);
                if (originalIndex !== -1) {
                    this.originalTodo.splice(originalIndex, 1);
                }
            }
        },
        addItem() {
            const newTask = {
                id: null,
                text: this.newTodo,
                done: false
            };

            let maxId = 0;
            this.originalTodo.forEach((task) => {
                if (task.id > maxId) {
                    maxId = task.id;
                }
            });

            newTask.id = maxId + 1;
            this.newTodo = '';

            if (newTask.text.length > 0) {
                this.todo.push(newTask);
                this.originalTodo.push(newTask);
            }
        },
        findTask() {
            this.originalTodo = this.todo.filter((task) => {
                return task.text.toLowerCase().includes(this.searchQuery.toLowerCase())
            });
            console.log(this.originalTodo);
        },
    },
    computed: {
        filteredTodo() {
            return this.originalTodo.filter((el) => {
                if (this.done === '') {
                    return el;
                }
                if (this.done === 'completed') {
                    return el.done;
                }
                if (this.done === 'notcompleted') {
                    return !el.done;
                }
            });
        }
    },
    mounted() {
        this.getData();
    },

}).mount('#app');
