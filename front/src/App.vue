
<template>
  <div id="app" class="container">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <div id="nav">
      <router-link to="/">Login</router-link> |
      <router-link to="/dashboard">Dashboard</router-link> |
      <router-link to="/products">Products</router-link> |
      <router-link to="/orders">Refill Orders</router-link> |
    </div>
    <button @click="logout">Logout</button>
    <router-view/>
  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>

<script>

import axios from 'axios';

axios.defaults.withCredentials = true
//Our Backend API Address, must be under the same domain.
axios.defaults.baseURL = 'http://localhost:4000'

export default {
  mounted() {

  },
  methods: {
    logout() {
      axios.post('/logout').then(response => {
        this.$router.push({ name: 'Home'});
      })
    }
  }
}
</script>
