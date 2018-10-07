
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('file-upload',require('./components/FileUpload_1.vue'));
Vue.component('image-component', require('./components/ImageuploadComponent.vue'));
Vue.component('image-upload', require('./components/ImageUpload.vue'));
Vue.component('image-app', require('./components/App.vue'));
Vue.component('home-app', require('./components/HomeApp.vue'));
Vue.component('home-app2', require('./components/HomeApp2.vue'));

const homeApp = new Vue({
    el: '#home-app',
    data: {
        items: [],
        mounted:function(){
            this.getStorage(); //method1 will execute at pageload
        },
    }
});

const homeApp2 = new Vue({
    el: '#home-app2',
    data: {
        datas: [],
        mounted:function(){
            this.getDetail(); //method1 will execute at pageload
        },
    }
});

const imageUpload = new Vue({
    el: '#image-upload',
    data: {
        items: [],
        showDelBtn: false,
        mounted:function(){
            this.getImages(); //method1 will execute at pageload
        },
    }
});

const imageApp = new Vue({
    el: '#image-app',
    data: {
        items: [],
        mounted:function(){
            this.getImages(); //method1 will execute at pageload
        },
    }
});


// const homeApp = new Vue({
//     el: '#home-app',
//     data: {
//         items: [],
//         hasError: true,
//         showModal: false,
//         newItem: {'name': '', 'age': '', 'profession': ''},
//         mounted: function () {
//             this.getStorage(); //method1 will execute at pageload
//         },
//         getStorage: function (){
//             var this1 = this;
//             axios.get('/home/overview').then(function (response) {
//                 this1.items = response.data;
//             });
//         }
//     }
// });


