import { createRouter, createWebHistory } from "vue-router";
const routes = [
    {
        path: "/",
        name: "Home",
        component: () => import("../components/Home.vue"),
    },
    {
        path: "/add-category",
        name: "/add-category",
        component: () => import("../pages/category.vue"),
    },

    {
        path: "/view-category",
        name: "view-category",
        component: () => import("../pages/viewCategory.vue"),
    },
    {
        path: "/editCategory/:id",
        name: "editCategory",
        component: () => import("../pages/EditCategory.vue"),
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;
