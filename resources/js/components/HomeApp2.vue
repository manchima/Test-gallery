<template>
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th colspan="3"><strong> Disk Usage Compositions </strong></th>
            </tr>
            <tr>
                <th>Type</th>
                <th>No of files</th>
                <th>Size</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="data in datas">
                <td>{{ data.type }}</td>
                <td>{{ data.total }}</td>
                <td>{{ data.size }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getDetail();
        },
        data: () => ({
            items: [],
            datas: [],
        }),
        methods: {
            getDetail() {
                axios.get('/home/detail').then(function (response) {
                    this1.datas = response.data;
                });
            },
        }
    }
</script>

<style scoped>

</style>
