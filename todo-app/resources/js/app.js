import './bootstrap';
import { createApp } from 'vue';
import TodoApp from './components/TodoApp.vue';
const app = createApp(TodoApp);
app.mount('#app');
import axios from 'axios';

// Get the CSRF token from the meta tag
let token = document.head.querySelector('meta[name="csrf-token"]');

// Set the token as a default header for Axios
if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found');
}

// You may also configure other things for axios

