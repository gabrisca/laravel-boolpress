<template>
    <main class="container-fluid">

        <Header />

        <!-- carico tutti i componenti iniettati dal router -->
        <router-view></router-view>

    </main>
</template>

<script>

import Header from './components/Header.vue'; // importo Header

export default {
    name: 'App',
    components: {
        Header
    },
    data(){
        return{

        }
    },
    created(){

    }
}
</script>

<style lang='scss'>

 @import '../sass/frontoffice/global';

</style>
