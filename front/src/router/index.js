import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Dashboard from '../views/Dashboard.vue'
import Products from '../views/Products.vue'
import Product from '../views/Product.vue'
import Orders from '../views/Orders.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard
  },
  {
    path: '/products',
    name: 'Products',
    component: Products,

  },
  {
    path: '/orders',
    name: 'Orders',
    component: Orders,
  },
  {
    path: '/product/:id',
    name: 'Product',
    component: Product,
    props: true
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
