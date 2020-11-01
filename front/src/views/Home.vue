<template>
  <div class="home">
    <form class="form-signin" action="#" method="POST" @submit.prevent="login">
      <div>
        <input type="email" class="form-control" required autofocus name="email" id="email" placeholder="email" v-model="email">
      </div>

      <div>
        <input type="password" class="form-control" required name="password" id="password" placeholder="password" v-model="password">
      </div>

      <div>
        <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
      </div>
    </form>
  </div>
</template>

<style>
.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>

<script>

import axios from 'axios';

axios.defaults.withCredentials = true
//Our Backend API Address, must be under the same domain.
axios.defaults.baseURL = 'http://localhost:4000'

export default {
  name: 'Home',
  data() {
    return {
    email: '',
    password: ''
  } },
  methods: {
    login() {
      axios.get('/sanctum/csrf-cookie').then(response => {
        //Login
        //console.log(response);

        axios.post('/login', {
          email: this.email,
          password: this.password
        }).then(response => {
          this.$router.push({ name: 'Dashboard' })
        })
      });
    }
  }
}
</script>
