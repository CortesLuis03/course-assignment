import StudentTeacherView from "@/components/student-teacher/StudentTeacherView";
import StudentTeacherCreate from "@/components/student-teacher/StudentTeacherCreate";

export default [
  {
    path: "/student-teacher",
    name: "StudentTeacherView",
    component: StudentTeacherView
  },
  {
    path: "/student-teacher/create",
    name: "StudentTeacherCreate",
    component: StudentTeacherCreate
  }
];
