import StudentsView from "@/components/students/StudentsView";
import StudentCreate from "@/components/students/StudentCreate";
import StudentEdit from "@/components/students/StudentEdit";

export default [
  {
    path: "/students",
    name: "StudentsView",
    component: StudentsView
  },
  {
    path: "/student/create",
    name: "StudentCreate",
    component: StudentCreate
  },
  {
    path: "/student/edit/:id",
    name: "StudentEdit",
    component: StudentEdit
  }
];
