import { createApp } from 'vue';
import App from './vue/app.vue';
import { createRouter, createWebHistory } from 'vue-router';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faPlusSquare, faTrash } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import Welcome from './vue/Welcome.vue';
import Register from './vue/Register.vue';
import Login from './vue/Login.vue';
import Logout from './vue/Logout.vue';
import TodoList from './vue/TodoList.vue';

const routes = [
    {
      path: '/',
      name: 'Welcome',
      component: Welcome
    },
    {
      path: '/register',
      name: 'Register',
      component: Register
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
        path: '/logout',
        name: 'Logout',
        component: Logout
      },
    {
      path: '/todo',
      name: 'TodoList',
      component: TodoList
    }
  ];


library.add(faPlusSquare, faTrash);

const router = createRouter({
    history: createWebHistory(),
    routes,
  });

const app = createApp(App);
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(router)
app.mount('#app');
