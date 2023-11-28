<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
                <h4 class="mx-auto">TAHVIS- {{title}}</h4>
        </div>
    </nav>
</template>

<script>
    export default {
        props:{
            title : String
        },
        data() {
            return {
                name: 'Tahsin',
            }

        }
    }
</script>
