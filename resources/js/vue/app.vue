<template>
    <div class="app-container">
      <header class="header">
        <h1 class="title">List App</h1>
        <item-form v-on:reloadItems="getItems()" />
      </header>
      <main class="main">
        <items-list :items="items" v-on:reloadItems="getItems()" />
      </main>
    </div>
  </template>

  <script>
  import itemForm from './itemForm';
  import itemsList from './itemsList';
  import axios from 'axios';

  export default {
    components: {
      itemForm,
      itemsList
    },
    data: function() {
      return {
        items: []
      }
    },
    methods: {
      getItems() {
        axios.get('api/items')
          .then(response => {
            this.items = response.data
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    created() {
      this.getItems();
    }
  }
  </script>

  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

  :root {
    --primary-color: #2c3e50;
    --secondary-color: #ecf0f1;
    --accent-color: #3498db;
    --font-family: 'Roboto', sans-serif;
  }

  .app-container {
    max-width: 800px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr;
    grid-gap: 1rem;
    padding: 1rem;
  }

  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: var(--secondary-color);
    padding: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .title {
    font-size: 2rem;
    color: var(--primary-color);
    font-weight: 700;
    margin: 0;
  }

  .main {
    background-color: var(--secondary-color);
    padding: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    padding: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 1rem;
  }

  .item input[type="checkbox"] {
    margin-right: 1rem;
  }

  .item .itemText {
    font-size: 1.2rem;
    font-weight: 500;
    color: var(--primary-color);
  }

  .deleteBtn {
    background: none;
    border: none;
    color: var(--primary-color);
    font-weight: 500;
    font-size: 1.2rem;
    cursor: pointer;
    transition: color 0.2s ease-in-out;
  }


  @media screen and (min-width: 768px) {
    .app-container {
      grid-template-columns: 1fr 2fr;
    }

    .header {
      grid-column: 1 / -1;
    }

    .main {
      grid-column: 2 / -1;
    }
  }
  </style>
