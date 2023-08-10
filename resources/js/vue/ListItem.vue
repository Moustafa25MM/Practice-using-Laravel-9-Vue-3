<template>
    <div class="item">
        <input
            type="checkbox"
            @change="toggleStatus()"
            v-model="item.completed"
        />
        <span :class="[item.completed ? 'completed' : '', 'itemText']">
            {{ item.name }}
        </span>
        <button @click="removeItem()" class="deleteBtn">
            <font-awesome-icon icon="trash"/>
        </button>
        <button @click="showModal = true" class="updateBtn">
            Update
        </button>

        <div v-if="showModal" class="modal">
            <div class="modal-content">
                <h2>Update</h2>
                <input type="text" v-model="newName" placeholder="Enter new name" />
                <button @click="updateItemName">Update Item</button>
                <button @click="showModal = false">Close</button>
            </div>
        </div>
    </div>
</template>

  <script>

import axios from 'axios';

  export default {
      props: ['item'],
      data() {
        return {
            showModal: false,
            newName: ''
        };
    },
      methods: {
          toggleStatus() {
              axios.put(`api/item/${this.item.id}`, {
                  item: this.item
              })
              .then(response => {
                  if (response.status == 200) {
                      this.$emit('itemStatus');
                  }
              })
              .catch(error => {
                  console.log(error);
              });
          },
          removeItem() {
              axios.delete(`api/item/${this.item.id}/`)
              .then(response => {
                  if (response.status == 200) {
                      this.$emit('itemStatus');
                  }
              })
              .catch(error => {
                  console.log(error);
              });
          },
          updateItemName() {
            axios.put(`api/item/${this.item.id}/name`, {
                item: { name: this.newName }
            })
            .then(response => {
                if (response.status == 200) {
                    this.$emit('itemStatus');
                    this.showModal = false;
                    this.newName = '';
                }
            })
            .catch(error => {
                console.log(error);
            });
        }
      }
  }
  </script>

  <style scoped>
  .modal {
    position: fixed;
    left: 0;
    top: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: #fff;
    padding: 20px;
    border-radius: 5px;
}
  .item {
      display: flex;
      justify-content: center;
      align-items: center;
  }

  .deleteBtn:hover {
    color: var(--accent-color);
  }
  .completed {
      text-decoration: line-through;
      color: #999999;
  }

  .itemText {
      width: 100%;
      margin-left: 20px;
  }

  .deleteBtn {
      background: #e6e6e6;
      border: none;
      color: #FF0000;
      outline: none;
  }
  </style>
