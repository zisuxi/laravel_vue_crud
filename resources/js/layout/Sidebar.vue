<template>
    <nav
        class="sidebar sidebar-offcanvas"
        id="sidebar"
        style="background-color: #ffffff"
    >
        <ul class="nav">
            <li class="nav-item">
                <router-link class="nav-link" to="/">
                    <i class="mdi mdi-grid-large menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </router-link>
            </li>

           <li class="nav-item">
                <router-link to="/add-category" class="nav-link">
                    <i class="menu-icon mdi mdi-file-document"></i>
                    <span class="menu-title">Category</span>
                </router-link>
            </li>
        </ul>
    </nav>
</template>
<script>
export default {
    name: "Sidebar",
};
</script>
