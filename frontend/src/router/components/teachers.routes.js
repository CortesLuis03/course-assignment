import TeachersView from "@/components/teachers/TeachersView";
import TeacherCreate from "@/components/teachers/TeacherCreate";
import TeacherEdit from "@/components/teachers/TeacherEdit";

export default [
  {
    path: "/teachers",
    name: "TeachersView",
    component: TeachersView
  },
  {
    path: "/teacher/create",
    name: "TeacherCreate",
    component: TeacherCreate
  },
  {
    path: "/teacher/edit/:id",
    name: "TeacherEdit",
    component: TeacherEdit
  }
];
