<template>
    <div class="max-w-md mx-auto p-4 bg-white shadow-md rounded-lg mt-10">
      <h1 class="text-2xl font-bold mb-6 text-center">My Todos</h1>
      <div class="flex mb-4">
        <input
          v-model="newTodo"
          type="text"
          placeholder="Add a new todo..."
          class="flex-grow border rounded py-2 px-3 mr-2 focus:outline-none focus:ring focus:border-blue-500"
          @keyup.enter="addTodo"
        />
        <button
          @click="addTodo"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-blue-300"
        >
          Add
        </button>
      </div>
      <ul class="space-y-2">
        <li
          v-for="todo in todos"
          :key="todo.id"
          class="flex items-center justify-between bg-gray-100 rounded py-2 px-3"
        >
          <div class="flex items-center">
            <input
              type="checkbox"
              :checked="todo.completed"
              @change="toggleTodo(todo)"
              class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
            />
            <input
              v-model="todo.title"
              class="flex-grow focus:outline-none"
              @blur="updateTodo(todo)"
            />
          </div>
          <button
            @click="deleteTodo(todo.id)"
            class="text-red-600 hover:text-red-800 focus:outline-none"
          >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </li>
      </ul>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        todos: [],
        newTodo: '',
      };
    },
    mounted() {
      this.fetchTodos();
    },
    methods: {
      async fetchTodos() {
        try {
          const response = await axios.get('/api/todos');
          this.todos = response.data;
        } catch (error) {
          console.error('Error fetching todos:', error);
        }
      },
      async addTodo() {
        if (this.newTodo.trim() === '') return;

        try {
          const response = await axios.post('/api/todos', { title: this.newTodo, completed: false });
          this.todos.push(response.data);
          this.newTodo = '';
        } catch (error) {
          console.error('Error adding todo:', error);
        }
      },
      async updateTodo(todo) {
        try {
          await axios.put(`/api/todos/${todo.id}`, { title: todo.title, completed: todo.completed }); // for updating
        } catch (error) {
          console.error('Error updating todo:', error);
        }
      },
      async toggleTodo(todo) {
        todo.completed = !todo.completed; // Toggle local state
        await this.updateTodo(todo); // Sync with API
      },
      async deleteTodo(id) {
        try {
          await axios.delete(`/api/todos/${id}`);
          this.todos = this.todos.filter(todo => todo.id !== id); // Remove from local state
        } catch (error) {
          console.error('Error deleting todo:', error);
        }
      },
    },
  };
  </script>

  <style scoped>
  /* You can add styles here if needed */
  </style>
