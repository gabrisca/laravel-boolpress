window.Vue = require('vue');

import App from './App.vue';
import router from './routes'; // importo router.js

const app = new Vue({
    el: '#app',
    router, // prendo il router
    render: h => h(App)
});

// The render() function is a central piece of Vue.

// In short, the templates that you write are transformed into these render funtions:

// <App>
//   <div>Hey</div>
// </app>

// is transformed to:

// render(h) {
//   return('App', [
//     h('div', 'Hey')
//   ])
// }

// But you can also write these functions on your own, instead of writing a template and have Vue / vue-loader convert it for you. That’s what this funtion that you show does:

// It renders the App component.

console.log('hello guest');
