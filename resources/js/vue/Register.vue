<template>
    <div class="container mt-5 text-center">
      <div class="card card--register" align="left">
        <div class="card-header card-header--register">Register Form</div>
        <div class="card-body">
          <form @submit.prevent="saveData">
            <div class="form-group">
              <label class="form-label">Name</label>
              <input type="text" v-model="student.name" name="name" id="name" class="form-control form-control--register" />
            </div>
            <div class="form-group">
              <label class="form-label">Email</label>
              <input type="email" v-model="student.email" name="email" id="email" class="form-control form-control--register" />
            </div>
            <div class="form-group">
              <label class="form-label">Password</label>
              <input type="password" v-model="student.password" name="password" id="password" class="form-control form-control--register" />
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn--register">Register</button>
          </form>
        </div>
      </div>
    </div>
  </template>

  <script>
    import axios from 'axios';

    export default {
      name: 'Register',
      data() {
        return {
          result: {},
          student: {
            name: '',
            email: '',
            password: ''
          }
        }
      },
      methods: {
        saveData() {
          // Validate input data
          if (this.student.name.trim() === '') {
            alert('Name is required');
            return;
          }
          if (this.student.email.trim() === '') {
            alert('Email is required');
            return;
          }
          if (this.student.password.trim() === '') {
            alert('Password is required');
            return;
          }
          if (this.student.password.trim().length < 8) {
            alert('Password must be at least 8 characters');
            return;
          }

          // Check if email is already registered
          axios.get(`http://127.0.0.1:8000/api/check-email/${this.student.email}`)
            .then(({ data }) => {
              if (data.status === true) {
                // Email is not registered, submit data to server
                axios.post('http://127.0.0.1:8000/api/register', this.student)
                  .then(({ data }) => {
                    console.log(data);
                    try {
                      alert('Registration Success');
                      this.$router.push('/login');
                    } catch (err) {
                      alert('Registration Failed');
                    }
                  })
                  .catch((error) => {
                    console.log(error.response.data);
                    alert(error.response.data.message);
                  });
              } else {
                // Email is already registered, display error message
                alert('Email is already registered');
              }
            })
            .catch((error) => {
              console.log(error.response.data);
              alert(error.response.data.message);
            });
        }
      }
    }
  </script>

  <style>
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
    }

    .card {
      width: 100%;
      max-width: 500px;
    }

    .card-header--register {
      background-color: #007bff;
      color: #fff;
      font-size: 1.5rem;
      font-weight: bold;
      text-align: center;
      padding: 1rem;
    }

    .form-control--register {
      height: 1rem;
      width: 100%;
      padding: 1rem;
      font-size: 1rem;
      line-height: 1;
      border-radius: 0.3rem;
    }

    .form-label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: bold;
    }

    .btn--register {
      font-size: 1.2rem;
      padding: 0.75rem 1.5rem;
    }
  </style>
