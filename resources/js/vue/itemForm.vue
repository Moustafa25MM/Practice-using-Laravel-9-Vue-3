<template>
    <div class="itemForm">
        <input type="text" v-model="item.name" />
        <font-awesome-icon
            icon="plus-square"
            @click="addItem()"
            :class="[item.name ? 'active' : 'inactive', 'plus']"
        ></font-awesome-icon>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data: function () {
        return {
            item: {
                name: "",
            },
        };
    },
    methods: {
        addItem() {
            if (this.item.name == "") {
                return;
            }
            axios
                .post("api/item/store", {
                    item: this.item, // Pass the item object directly
                    userId: localStorage.getItem("userId"),
                })
                .then((response) => {
                        this.item = "";
                        this.$emit("reloadItems");
                        console.log("reloadItems event emitted");

                })
                .catch((error) => {
                    console.log(error);
                    console.log('err')
                });
        },
    },
};
</script>

<style scoped>
.itemForm {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    padding: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.itemForm input[type="text"] {
    background-color: var(--secondary-color);
    border: none;
    outline: none;
    padding: 1rem;
    font-size: 1.2rem;
    font-weight: 500;
    color: var(--primary-color);
    border-radius: 0.5rem;
    flex-grow: 1;
    margin-right: 1rem;
}
.itemForm .addBtn {
    background-color: var(--accent-color);
    border: none;
    outline: none;
    color: #fff;
    font-size: 1.2rem;
    font-weight: 500;
    padding: 1rem 2rem;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}
.itemForm .addBtn:hover {
    background-color: #2980b9;
}

input {
    background: #f7f7f7;
    border: 0;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}

.plus {
    font-size: 20px;
}

.active {
    color: #00ce25;
}

.inactive {
    color: #999;
}
</style>
