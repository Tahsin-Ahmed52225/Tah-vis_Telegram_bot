
<template>

</template>

<script>
    export default {
        data() {
            return {
                name: 'Tahsin',
                tasks: [],
            }

        },
        methods:{
            getAllTasks(){
                axios.get(`view-tasks`,{
                    params: {
                        user_id: window.Telegram.WebApp.initDataUnsafe.user.id,
                    }
                }).then(res => {
                    console.log(res.data);
                });
            }
        },
        created(){
            this.getAllTasks();
        }
    }
</script>
