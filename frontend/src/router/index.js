import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import StudentsView from '@/components/students/StudentsView'
import StudentCreate from '@/components/students/StudentCreate'
import StudentEdit from '@/components/students/StudentEdit'
import NavBar from '@/components/NavBar'


Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/students',
      name: 'StudentsView',
      component: StudentsView
    },
    {
      path: '/student/create',
      name: 'StudentCreate',
      component: StudentCreate
    },
    {
      path: '/student/edit/:id',
      name: 'StudentEdit',
      component: StudentEdit
    }
  ]
})
