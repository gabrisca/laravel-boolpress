import Vue from 'vue'; //importo vue
import VueRouter from 'vue-router'; // importo vueRouter

Vue.use(VueRouter); // usa VueRouter

//importo le pagine
import Home from './pages/Home.vue';
import About from './pages/About.vue';
import Blog from './pages/Blog.vue';
import Contact from './pages/Contact.vue';
import PostDetail from './pages/PostDetail.vue';
import Error404 from './pages/Error404.vue';



//creiamo la classe Router
const router = new VueRouter({
    mode: 'history', // tiene in memoria la navigazione nel browser
    linkExactActiveClass: 'active', // aggiunge una classe active personalizzata
    routes: [
        {
            path: '/',
            name: 'home', // serve per richiamare la rotta
            component: Home
        },
        {
            path: '/about',
            name: 'about', // serve per richiamare la rotta
            component: About
        },
        {
            path: '/blog',
            name: 'blog', // serve per richiamare la rotta
            component: Blog
        },
        {
            path: '/contacts',
            name: 'contacts', // serve per richiamare la rotta
            component: Contact
        },
        {
            path: '/post/:slug', // parametro slug di post
            name: 'postDetail', // serve per richiamare la rotta
            component: PostDetail
        },
        {
            path: '/*', // * tutte le altre rotte
            name: 'error404', // serve per richiamare la rotta
            component: Error404
        },
    ]
})

export default router; // esporto router
