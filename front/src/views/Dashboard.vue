<template>
  <div class="dashboard">
    <h1>Dashboard View</h1>
    <div>Email: {{ email }}</div>
    <div>Department: {{ department }}</div>
  </div>
</template>

<script>

import axios from 'axios';

axios.defaults.withCredentials = true
//Our Backend API Address, must be under the same domain.
axios.defaults.baseURL = 'http://localhost:4000'

export default {
  data() {
    return {
      email: '',
      department: '',
    }
  },
  mounted() {
    axios.get('/api/user').then(response => {
      this.email = response.data.email;
      this.department = response.data.department;
    }).catch(() => {
      this.$router.push({ name: 'Home'});
    })
  },
  methods: {

  }
}
</script>
