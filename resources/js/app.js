
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

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('image-app', require('./components/App.vue'));
Vue.component('image-upload', require('./components/ImageUploader.vue'));
Vue.component('upload-panel', require('./components/UploadPanel.vue'));



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

const uploadPanel = new Vue({
    el: '#upload-panel',
    data: {
        items: [],
        showDelBtn: false,
        mounted:function(){
            this.getImages(); //method1 will execute at pageload
        },
    }
});
