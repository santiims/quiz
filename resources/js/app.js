import Vue from 'vue';

Vue.component('quiz', require('./vue-components/quiz/components/main.vue').default);

new Vue({
    el: "#app"
});