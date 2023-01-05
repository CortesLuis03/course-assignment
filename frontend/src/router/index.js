import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'

import studentsRoutes from './components/students.routes'
import teachersRoutes from './components/teachers.routes'
import coursesRoutes from './components/courses.routes'
import relationshipsRoutes from './components/relationships.routes'



Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    ...relationshipsRoutes,
    ...studentsRoutes,
    ...teachersRoutes,
    ...coursesRoutes
  ]
})
