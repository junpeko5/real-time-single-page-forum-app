import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/login/Login'
import Logout from '../components/login/Logout'
import Signup from '../components/login/Signup'
import Forum from '../components/forum/Fourm'
import Read from '../components/forum/Read'
import Create from '../components/forum/Create'

Vue.use(VueRouter)

const routes = [
    {
        path: '/login',
        component: Login
    },
    {
        path: '/logout',
        component: Logout
    },
    {
        path: '/signup',
        component: Signup
    },
    {
        path: '/forum',
        name: 'forum',
        component: Forum
    },
    {
        path: '/question/:slug',
        name: 'read',
        component: Read
    },
    {
        path: '/ask',
        component: Create
    }
]

const router = new VueRouter({
    routes,
    mode: 'history'
})

export default router
