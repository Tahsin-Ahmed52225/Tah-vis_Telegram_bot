<template>
    <div class="container">
        <Menu title = "Task Module"/>
        <Body/>
        <Footer/>
    </div>


</template>


<script >
    import Menu from '../components/Menu.vue';
    import Body from '../components/Body.vue';
    import Footer from '../components/Footer.vue';

    export default{
            components: {
                Menu,Body,Footer
            },
            mounted() {
                console.log('Component mounted.')
            }
        }
</script>
