
<template>

    <div class="card">
        <p>
            <div class="w-100 d-flex justify-content-between mb-3">
                <button type="button" class="btn btn-primary btn-sm">
                    All Task <span class="badge badge-light">{{ tasks.length }}</span>
                </button>
                <button type="button" class="btn btn-success btn-sm">
                    Completed <span class="badge badge-light">{{ tasks.filter(x => x.complete == 1).length }}</span>
                </button>
                <button type="button" class="btn btn-danger btn-sm">
                    Task Left <span class="badge badge-light">{{ tasks.filter(x => x.complete == 0).length }}</span>
                </button>
            </div>

            <div class="form-check" v-for="(data , index) in tasks">
                <input class="form-check-input" type="checkbox" :checked="data.complete" @click="isComplete(data,index)">
                <label class="form-check-label"  :class="data.complete ? `taskLine` : ``">
                    {{ data.task }}
                </label>
            </div>
        </p>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                tasks: [],
                isStrickThrough: false,
            }

        },
    methods: {
            getAllTasks(){
                axios.get(`view-tasks`,{
                    params: {
                        user_id: encodeURIComponent(window.btoa(window.Telegram.WebApp.initDataUnsafe.user.id)),
                    }
                }).then(res => {
                    this.tasks = res.data.data;
                });
            },
            isComplete(data, index) {
                axios.put(`/task`,{
                    user_id: encodeURIComponent(window.btoa(window.Telegram.WebApp.initDataUnsafe.user.id)),
                    task : data,
                }).then(res => {
                    this.tasks[index] = res.data.data;
                });
            }
        },
        created(){
           // console.log(window.Telegram.WebApp.initDataUnsafe.user.id);
            this.getAllTasks();
        }
    }
</script>

<style scoped>

    .taskLine{
        text-decoration: line-through;
    }
    .card {
    max-width: 300px;
    min-height: 80vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    max-width: 500px;
    height: 300px;
    padding: 35px;

    border: 1px solid rgba(255, 255, 255, .25);
    border-radius: 20px;
    background-color: rgba(255, 255, 255, 0.45);
    box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.25);

    backdrop-filter: blur(15px);
    }

    .card-footer {
    font-size: 0.65em;
    color: #446;
    }
</style>
