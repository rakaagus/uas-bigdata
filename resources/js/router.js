import { createRouter, createWebHistory } from 'vue-router'
import { useUserStore } from "./store/user";

// layouts
import Dashboard from "./layouts/Dashboard.vue";
import Auth from "./layouts/Auth.vue";

// Book from dashboard views
import Buku from "./views/Dashboard/buku/Buku.vue";
import AddBuku from "./views/Dashboard/buku/AddBuku.vue";
import DetailBuku from './views/Dashboard/buku/DetailBuku.vue';
import UpdateBuku from './views/Dashboard/buku/UpdateBook.vue';

//bookshelf route from dahsboard views
import Bookshelf from "./views/Dashboard/Bookshelf/Bookshelf.vue";
import AddBookshelf from "./views/Dashboard/Bookshelf/AddBookshelf.vue";
import UpdateBookshelf from "./views/Dashboard/Bookshelf/UpdateBookshelf.vue";

import Login from "./views/Auth/LoginView.vue";
import Register from "./views/Auth/RegisterView.vue";
import VerificationCode from './views/Auth/VerificationCode.vue';
import ForgetPassView from "./views/Auth/ForgetPassView.vue";


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/dashboard',
            component: Dashboard,
            redirect: '/dashboard/buku',
            name: "dashboard",
            children: [
                {
                    path: '/dashboard/bookshelf',
                    name: "dahboard-bookshelf",
                    component: Bookshelf,
                    meta: {
                        requiredLogin: true
                    }
                },
                {
                    path: '/dashboard/addbookshelf',
                    name: "dahboard-bookshelf-add",
                    component: AddBookshelf,
                    meta: {
                        requiredLogin: true
                    }
                },
                {
                    path: '/dashboard/updatebookshelf/:id',
                    name: "dahboard-bookshelf-update",
                    component: UpdateBookshelf,
                    meta: {
                        requiredLogin: true
                    }
                },
                {
                    path: '/dashboard/buku',
                    name: "dahboard-buku",
                    component: Buku,
                    meta: {
                        requiredLogin: true
                    }
                },
                {
                    path: '/dashboard/addbuku',
                    name: "dahboard-buku-add",
                    component: AddBuku,
                    meta: {
                        requiredLogin: true
                    }
                },
                {
                    path: '/dashboard/detailbuku/:id',
                    name: "dahboard-buku-detail",
                    component: DetailBuku,
                    meta: {
                        requiredLogin: true
                    }
                },
                {
                    path: '/dashboard/updatebuku/:id',
                    name: "dahboard-buku-update",
                    component: UpdateBuku,
                    meta: {
                        requiredLogin: true
                    }
                }
            ]
        },
        {
            path: "/auth",
            component: Auth,
            redirect: "/auth/login",
            children: [
              {
                path: '/auth/login',
                name: "login",
                component: Login
              },
              {
                path: '/auth/register',
                name: "register",
                component: Register
              },
              {
                path: '/auth/verif',
                name: "verification",
                component: VerificationCode
              },
              {
                path: '/auth/forget-pass',
                name: "forget-pass",
                component: ForgetPassView
              },
            ]
        },
        {
            path: '/cacthAll(.*)',
            redirect: '/'
        }
    ]
})

router.beforeEach((to, from) => {
    const auth = useUserStore()
    if(to.meta.requiredVeri){
        if(!auth.isNotVerification){
            alert("Anda Tidak Memiliki akses di halaman ini")
            return {
                path: '/auth'
            }
        }
    }

    if(to.meta.requiredAdmin){
        if(!auth.isAdmin){
            alert("Halaman ini hanya bisa diakses oleh admin")
            return {
                path: '/auth'
            }
        }
    }

    if(to.meta.requiredLogin){
        if(!auth.isLogin){
            alert("Anda Harus login Terlebih Dahulu")
            return {
                path: '/auth'
            }
        }
    }
})


export default router
