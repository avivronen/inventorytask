<template>
  <div class="product">
    <h1>Product View</h1>
    <div>id: {{ $route.params.id }}</div>

    <div>Name: {{ product.name }}</div>
    <div>Currently in stock: {{ product.inStock ? 'Yes': 'No' }}</div>

    <div class="clear"></div>
<hr>
    <h3>Refill Orders</h3>
    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Order Date</th>
          <th>Completed at</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="order in orders">
          <th scope="row">{{ order.id }}</th>
          <td>{{ order.created_at }}</td>
          <td v-if="order.created_at != order.updated_at">{{ order.updated_at }}</td>
          <td v-if="order.created_at == order.updated_at">Pending</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>


<script>

import axios from 'axios';
import router from "@/router";

axios.defaults.withCredentials = true
//Our Backend API Address, must be under the same domain.
axios.defaults.baseURL = 'http://localhost:4000'

export default {
  data() {
    return {
      product : {},
      orders: {},
      client_name: ''
    }
  },
  props: ['id'],
  mounted() {
    axios.get('/api/user').then(response => {
    }).catch(() => {
      this.$router.push({ name: 'Home'});
    });

    axios.get('api/products/'+this.id).then(response => {
      this.product = response.data.product;
      this.orders = response.data.orders;
    })

  },
  methods: {
    sell() {
      axios.post('/api/sells', {
        id: this.product.id,
        client_name: this.client_name
      }).then(response => {
        this.$router.push({ name: 'Products' })
      }).catch(e => {
        console.log('error',e);
      })
    }
  }
}
</script>
