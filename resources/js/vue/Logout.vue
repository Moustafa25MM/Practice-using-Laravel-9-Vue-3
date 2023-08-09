<template>
    <div>
      <button @click="logout">Logout</button>
    </div>
  </template>

  <script>
  import axios from "axios";

  export default {
    name: "Logout",
    data() {
      return {};
    },
    methods: {
      logout() {
        axios
          .post("http://127.0.0.1:8000/api/logout")
          .then(({ data }) => {
            if (data.status === true) {
              localStorage.removeItem("userId"); // Clear local storage
              alert("Logout Successfully");
              this.$router.push("/login"); // Redirect to login page
            }
          })
          .catch((err) => {
            alert("Error, please try again");
          });
      },
    },
  };
  </script>
