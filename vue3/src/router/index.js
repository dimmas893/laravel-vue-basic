import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import StudentsView from '../views/students/view.vue'
import StudentsCreate from '../views/students/create.vue'
import StudentsEdit from '../views/students/edit.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/students',
      name: 'students',
      component: StudentsView
    },
   {
      path: '/students/create',
      name: 'studentscreate',
      component: StudentsCreate
    },
      {
      path: '/students/:id/edit',
      name: 'studentsedit',
      component: StudentsEdit
    }
  ]
})

export default router
