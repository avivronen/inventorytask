<template>
  <div class="products">
    <h1>Products</h1>

    <div class="alert-success">{{ message }}</div>

    <form class="form-signin" action="#" method="POST" @submit.prevent="requestProduct">
      <div>
        <input type="text" class="form-control" required autofocus name="name" id="name" placeholder="Product Name" v-model="product_name">
      </div>

      <div>
        <button type="submit" class="btn btn-sm btn-primary btn-block">Request Logistic To Add Product To Stock</button>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">In Stock?</th>
          <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="product in products">
          <th scope="row">{{ product.id }}</th>
          <td><a :href="'/Product/' + product.id">{{ product.name }}</a></td>
          <td><span> {{ product.inStock ? 'Yes' : 'No' }}</span></td>
          <td><button type="submit" v-if="product.inStock == 1" class="btn btn-sm btn-primary btn-block" @click="order(product.id)">Submit refill stock request</button></td>
        </tr>
        </tbody>
      </table>
    </div>
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
  data() {
    return {
      products: {},
      message: '',
      product_name : '',
    }
  },
  mounted() {
    this.fetchProducts()
  },
  methods: {
    fetchProducts(message = '') {
      axios.get('api/products').then(response => {
        this.products = response.data.data;
        this.message = message;
      }).catch(e => {
        this.$router.push({ name: 'Home' })
      })
    },

    order(product_id) {
      axios.patch('/api/products/'+product_id, {
        id: product_id,
      }).then(response => {
        this.fetchProducts('Refill Requested');
      }).catch(e => {
        console.log('error',e);
        this.$router.push({ name: 'Home' })
      })
    },

    requestProduct() {
      axios.post('/api/products/', {
        name: this.product_name,
      }).then(response => {
        this.product_name = '';
        this.fetchProducts('Product Requested');
      }).catch((e) => {
        this.product_name = '';
        this.message = e;
      })
    }

  }
}
</script>
