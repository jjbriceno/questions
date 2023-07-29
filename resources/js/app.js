/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import Vue from 'vue';

import VueRouter from 'vue-router';

import App from './App.vue';

import PresentationComponent from './components/PresentationComponent.vue';

import AdminLoginComponent from './components/AdminLoginComponent.vue';

import PersonalInfoComponent from './components/PersonalInfoComponent.vue';

import QuestionnaireComponent from './components/QuestionnaireComponent.vue';

import AdminActionsComponent from './components/AdminActionsComponent.vue';

Vue.use(VueRouter);

// window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('App', require('./App.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    routes: [
        { path: '/', redirect: '/presentation' },
        { path: '/presentation', component: PresentationComponent },
        { path: '/admin-login', component: AdminLoginComponent },
        { path: '/admin-actions', component: AdminActionsComponent },
        { path: '/personal-info', component: PersonalInfoComponent },
        { path: '/questionnaire/:id', name: 'questionnaire', component: QuestionnaireComponent },
    ],
});

router.beforeEach(async (to, from, next) => {
    if (from.fullPath.split('/').length === 3 && to.fullPath == '/personal-info') {
        next(from.fullPath);
    }
    next();
});


const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router
});
