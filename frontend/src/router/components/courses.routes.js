import CoursesView from "@/components/courses/CoursesView";
import CourseCreate from "@/components/courses/CourseCreate";
import CourseEdit from "@/components/courses/CourseEdit";

export default [
  {
    path: "/courses",
    name: "CoursesView",
    component: CoursesView
  },
  {
    path: "/course/create",
    name: "CourseCreate",
    component: CourseCreate
  },
  {
    path: "/course/edit/:id",
    name: "CourseEdit",
    component: CourseEdit
  }
];
