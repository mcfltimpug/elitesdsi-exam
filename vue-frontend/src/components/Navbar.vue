<template>
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid p-3">
            <router-link to="/" class="nav-bar brand text-decoration-none fw-bold fs-4 text-primary me-1">K-Pop Sales</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link active">Dashboard</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/artists" class="nav-link active">Artists</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/albums" class="nav-link active">Albums</router-link>
                    </li>
                </ul>
                <form class="d-flex align-items-center">
                    <h6 class="me-3 fst-italic">Welcome, User!</h6>
                    <button type="button" class="btn btn-outline-dark" @click="logout">Log Out</button>
                </form>
            </div>
        </div>
    </nav>
</template>

<script setup>
import axios from 'axios';
import { useRouter } from 'vue-router';
import { ref } from 'vue';
const token = ref(localStorage.getItem('token'));

const router = useRouter();

const logout = () => {
console.log(token.value)
  axios.post('http://127.0.0.1:8000/api/auth/logout', {}, {
    headers: {
      Authorization: `Bearer ${token.value}`
    }
  })
  .then(response => {
    localStorage.removeItem('token');
    token.value = null;
    console.log('Logout Successful');
    router.push('/');
  })
  .catch(error => {
    console.error('Logout Error:', error.response.data);
  });
};

</script>

<style>

</style>