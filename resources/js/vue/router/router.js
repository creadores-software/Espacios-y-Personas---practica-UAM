import { createRouter, createWebHistory } from "vue-router"
import axios from 'axios';

//Auth
import Login from '../components/auth/Login.vue'

//Landing
import Presentation from '../components/landing-page/landing-components/Presentacion.vue'

//ADMIN
import PersonList from '../components/admin/people-admin/PersonList.vue'
import Save from '../components/admin/people-admin/Save.vue'
import SaveSpace from '../components/admin/space-admin/SaveSpace.vue'

//People
import People from '../components/people/People.vue';

import EditImagePerson from '../components/admin/people-admin/EditImage.vue'

import PersonProfile from '../components/people/PersonProfile.vue';

import EditCategoryPerson from '../components/admin/people-admin/EditCategoryPerson.vue'

//Spaces
import Spaces from '../components/spaces/Spaces.vue';

import SpaceProfile from '../components/spaces/SpaceProfile.vue';

import SpaceList from '../components/admin/space-admin/SpaceList.vue'

//Events
import Events from '../components/events/Events.vue';

//Reservas
import Bookings from '../components/events/Bookings.vue';

//About
import About from '../components/about/About.vue';

//Admin 
import Admin from '../components/admin/Admin.vue';

//Seeker
import Seeker from '../components/seeker/Seeker.vue';

import Controller from '../components/controllerTest/ControllerTest.vue';

import CategorySpace from '../components/admin/space-admin/CategorySpace.vue';

import ReservesSpace from '../components/admin/space-admin/ReservesSpace.vue';




const routes = [
    {
        name: 'Bookings',
        path: '/vue/events/booking',
        component: Bookings
    },
    {
        name: 'Login',
        path: '/vue/login',
        component: Login
    },
    {
        name: 'Presentation',
        path: '/vue',
        component: Presentation
    },
    {
        name: 'People',
        path: '/vue/people',
        component: People
    },
    {
        name: 'Spaces',
        path: '/vue/spaces',
        component: Spaces
    },
    {
        name: 'CategorySpace',
        path: '/vue/admin/space/editCategory/:slug?',
        component: CategorySpace
    },
    {
        name: 'Events',
        path: '/vue/events',
        component: Events
    },
    {
        name: 'About',
        path: '/vue/about',
        component: About
    },
    {
        name: 'Admin',
        path: '/vue/admin',
        component: Admin
    },
    {
        name: 'PersonList',
        path: '/vue/admin/people',
        component: PersonList
    },
    {
        name: 'Save',
        path: '/vue/admin/people/save/:slug?',
        component: Save
    },
    {
        name: 'PersonProfile',
        path: '/vue/people/profile/:slug?',
        component: PersonProfile
    },
    {
        name: 'SpaceList',
        path: '/vue/admin/space',
        component: SpaceList,
    },
    {
        name: 'SpaceProfile',
        path: '/vue/space/profile/:slug?',
        component: SpaceProfile,
    },
    {
        name : 'Seeker',
        path: '/vue/seeker',
        component: Seeker,
    },
    {
        name: 'Controller',
        path: '/vue/controllerTest',
        component: Controller,
    },
    {
        name: 'SaveSpace',
        path: '/vue/admin/space/save/:slug?',
        component : SaveSpace,
    },
    {
        name: 'EditImagePerson',
        path: '/vue/admin/person/editImage/:slug?',
        component: EditImagePerson,
    },
    {
        name: 'EditCategoryPerson',
        path: '/vue/admin/person/editCategory/:slug?',
        component: EditCategoryPerson,
    },
    {
        name: 'ReservesSpace',
        path: '/vue/admin/space/reservesSpace/:slug?',
        component: ReservesSpace,
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

// function isAuthenticated(){
//     axios.post("/api/perfil", this.form).then((res) => {
//         return res
//     }, function(err){
//         console.log(err)
//     });
// }

// router.beforeEach((to, from, next) => {
//     if (to.name !== 'Login' && isSet(isAuthenticated()) ) next({ name: 'Login' })
//     else next()
//   })



export default router