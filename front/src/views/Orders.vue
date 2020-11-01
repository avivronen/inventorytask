<template>
  <div class="orders">
    <h1>orders</h1>

    <div class="alert-success">{{ message }}</div>

    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Order Date</th>
          <th scope="col">Product Name</th>
          <th scope="col">Mark Product as In Stock</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="order in orders">
          <th scope="row">{{ order.id }}</th>
          <td>{{ order.created_at }}</td>
          <th><a :href="'/Product/' + order.product.id">{{ order.product.name }}</a></th>
          <td><button type="submit" v-if="order.product.inStock == 0" class="btn btn-sm btn-primary btn-block" @click="refill(order.id)">Confirm Refill</button></td>
        </tr>
        </tbody>
      </table>
    </div>
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
      orders: {},
      message: '',
    }
  },
  mounted() {
    this.fetchOrders()
  },
  methods: {
    fetchOrders(message = '') {
      axios.get('api/orders').then(response => {
        this.orders = response.data.data;
        this.message = message;
      }).catch(e => {
        this.$router.push({ name: 'Home' })
      })
    },
    refill(order_id) {
      axios.patch('/api/orders/'+order_id, {
        id: order_id,
      }).then(response => {
        this.fetchOrders('Order ' + order_id + ' Updated');
      }).catch(e => {
        console.log('error',e);
        this.$router.push({ name: 'Home' })
      })
    }
  }
}
</script>
