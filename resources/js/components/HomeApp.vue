<template>
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th colspan="2"><strong> Disk Usage Overview </strong></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in items">
                <td>Total Size:</td>
                <td>{{ item.size }}</td>
            </tr>
            <tr v-for="item in items">
                <td>No of files:</td>
                <td>{{ item.total }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <!--<div class="container">-->
        <!--<table class="table table-bordered">-->
            <!--<thead>-->
            <!--<tr>-->
                <!--<th colspan="3"><strong> Disk Usage Compositions </strong></th>-->
            <!--</tr>-->
            <!--<tr>-->
                <!--<th>Type</th>-->
                <!--<th>No of files</th>-->
                <!--<th>Size</th>-->
            <!--</tr>-->
            <!--</thead>-->
            <!--<tbody>-->
            <!--<tr v-for="data in datas">-->
                <!--<td>{{ data.type }}</td>-->
                <!--<td>{{ data.total }}</td>-->
                <!--<td>{{ data.size }}</td>-->
            <!--</tr>-->
            <!--</tbody>-->
        <!--</table>-->
    <!--</div>-->
</template>

<script>
    export default {
        mounted() {
            this.getStorage();
        },
        data: () => ({
            items: [],
        }),
        methods: {
            getStorage() {
                var this1 = this;
                axios.get('/home/overview').then(function (response) {
                    this1.items = response.data;
                });
            },
        }
    }
</script>

<style scoped>

</style>
