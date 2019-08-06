<template>
    <nav id="main-header" class="d-flex justify-content-between align-items-center">
        <ul class="nav">
            <router-link to="/products" tag="li" active-class="active" class="nav-item"><a class="nav-link">Products</a></router-link>
            <router-link to="/cart" tag="li" active-class="active" class="nav-item"><a class="nav-link">Cart</a></router-link>
        </ul>
        <div v-if="$store.state.users.is_logged" class="d-flex justify-content-between align-items-center">
            <button class="btn btn-seconday nav-link">Logout</button>
        </div>
        <div v-else class="d-flex justify-content-between align-items-center">
            <router-link to="/login" active-class="active" class="nav-item"><a class="nav-link">Login</a></router-link>
            <router-link to="/registration" active-class="active" class="nav-item"><a class="nav-link">Register</a></router-link>
        </div>

    </nav>
</template>

<script>
    export default {
        mounted() {
            console.log('Header mounted.')
        }
    }
</script>
<style scoped>
.active {
    background: #000;
}
</style>
