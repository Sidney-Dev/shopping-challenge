<template>
    <main id="main" class="container">
        <Header></Header>
        <router-view></router-view>
    </main>
</template>

<script>
import Header from './components/Header.vue';
export default {
    components: {
        Header 
    }
}
</script>

<style>
    .error {
        border-color: red;
    }
</style>

