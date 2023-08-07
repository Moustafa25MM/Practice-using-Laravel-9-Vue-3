<template>
    <div>
      <nav>
        <ul>
          <li><router-link to="/">Welcome</router-link></li>
          <li><router-link to="/register">Register</router-link></li>
          <li><router-link to="/login">Login</router-link></li>
        </ul>
      </nav>
      <router-view/>
    </div>
  </template>

  <script>
  export default {
    name: 'App'
  }
  </script>

  <style>
  nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: var(--secondary-color);
    padding: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  nav ul {
    list-style: none;
    display: flex;
    align-items: center;
    margin: 0;
    padding: 0;
  }

  nav ul li {
    margin-right: 1rem;
  }

  nav ul li:last-child {
    margin-right: 0;
  }
  </style>
