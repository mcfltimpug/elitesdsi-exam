<template>
    <div class="card p-5">
        <h4 class="text-center">Admin Login</h4>
        <div class="card-body">
            <form @submit.prevent="login">
                <div class="mb-3">
                    <label for="usernameInput" class="form-label">Username</label>
                    <input type="text" class="form-control" id="usernameInput" v-model="username">
                </div>
                <div class="mb-3">
                    <label for="passwordInput" class="form-label">Password</label>
                    <input type="password" class="form-control" id="passwordInput" v-model="password">
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios';
import { useRouter } from 'vue-router';

const username = ref();
const password = ref();
const token = ref(null);
const router = useRouter();


const login = () => {
  axios.post('http://127.0.0.1:8000/api/auth/login', {
    username: username.value,
    password: password.value
  })
  .then(response => {
    localStorage.setItem('token', response.data.token);
    token.value = response.data.token;
    console.log('Login Successful');
    router.push('/dashboard');
  })
  .catch(error => {
    console.error('Login Error:', error.response.data);
  });
};
</script>

<style scoped>

</style>