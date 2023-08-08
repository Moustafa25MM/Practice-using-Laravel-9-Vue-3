<template>
    <div class="row">
        <div class="col-sm-4">
            <h2 align="center">Login</h2>
            <form @submit.prevent="LoginData">
                <div class="form-group" align="left">
                    <label>Email</label>
                    <input
                        type="email"
                        v-model="student.email"
                        class="form-control form-control--login"
                        placeholder="Email"
                    />
                </div>
                <div class="form-group" align="left">
                    <label>Password</label>
                    <input
                        type="password"
                        v-model="student.password"
                        class="form-control form-control--login"
                        placeholder="Password"
                    />
                </div>
                <button type="submit" class="btn btn-primary btn--login">
                    Login
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Login",
    data() {
        return {
            result: {},
            student: {
                email: "",
                password: "",
            },
        };
    },
    methods: {
        LoginData() {
            axios
                .post("http://127.0.0.1:8000/api/login", this.student)
                .then(({ data }) => {
                    console.log(data);
                    try {
                        if (data.status === true) {
                            localStorage.setItem("userId", data.userId); // Save user ID in local storage
                            alert("Login Successfully");
                            this.$router.push("/todo");
                        } else {
                            alert("Login failed");
                        }
                    } catch (err) {
                        alert("Error, please try again");
                    }
                });
        },
    },
};
</script>

<style>
.form-control--login {
    height: 1rem;
    width: 100%;
    padding: 1rem;
    font-size: 1rem;
    line-height: 1;
    border-radius: 0.3rem;
}

.btn--login {
    font-size: 1.2rem;
    padding: 0.75rem 1.5rem;
}
</style>
