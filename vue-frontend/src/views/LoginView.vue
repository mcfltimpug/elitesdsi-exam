<template>
    <div class="login">
        <div class="container">
            <div class="row pt-5">
                <div class="col-12 col-md-9 mx-auto mt-5">
                    <LoginForm />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import LoginForm from '@/components/LoginForm.vue';
</script>

<style scoped>
    .login {
        height: 100vh;
        background-image: url('../assets/login-bg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>