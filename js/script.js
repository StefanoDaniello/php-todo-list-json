
const { createApp } = Vue;

createApp({
    data() {
        return {
            originalTodo: [],
            todo: [],
            newTodo: '',
            searchQuery: '',
            done: '',
            newTask : {
                id: '',
                text: '',
                done: false
            },
            apiUrl:'server.php',
            lastId: null,

        }
    },
    methods: {
        getData() {
            axios.get(this.apiUrl).then((res)=>{
                this.originalTodo = res.data;
                this.todo = res.data;
                this.lastId = this.originalTodo.length - 1;
                // console.log(this.originalTodo);
            }).catch((err)=>{
                console.log(err)
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
            const task ={...this.newTask};
            this.newTask= {
                id: '',
                text: this.newTodo,
                done: null,
            };
            // console.log(task);
            this.lastId += 1;
            task.id=this.lastId;
            task.text=this.newTodo;
            task.done=false;
            // utilizzo il form data per inviare i valori a $_POST
            const data = new FormData();
            for (let key in task) {
                data.append(key, task[key]);
            }
            axios.post(this.apiUrl, data).then((res) => {
                this.originalTodo = res.data
                this.lastId = this.originalTodo.length - 1;
                location.reload();
            }).catch((err)=>{
                console.log(err)
            })
            this.newTodo = '';
        },
        findTask() {
            this.originalTodo = this.todo.filter((task) => {
                return task.text.toLowerCase().includes(this.searchQuery.toLowerCase())
            });
            // console.log(this.originalTodo);
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
