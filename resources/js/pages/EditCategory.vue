<template>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->

        <!-- ===================Include Header ===================-->

        <Header />
        <!-- ===================Include Header ===================-->

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!--=================== InClude Side Bar ===================-->
            <Sidebar />
            <!--=================== InClude Side Bar ===================-->

            <!-- partial -->
            <div class="main-panel">
                <div
                    class="content-wrapper"
                    style="background-color: rgb(233 238 247)"
                >
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Update Category {{ name }}</strong>
                        </div>
                        <div class="col-md-6">
                            <router-link
                                to="/view-category"
                                class="btn btn-primary text-white float-end"
                                >View Category</router-link
                            >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-3 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Edit Category</h4>
                                    <form class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1"
                                                ><strong
                                                    >Category Name</strong
                                                ></label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="exampleInputUsername1"
                                                placeholder="Enter Your Category Name"
                                                v-model="name"
                                                required
                                            />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"
                                                ><strong
                                                    >Category
                                                    Description</strong
                                                ></label
                                            >
                                            <input
                                                type="hidden"
                                                name="id"
                                                v-model="id"
                                            />
                                            <textarea
                                                id=""
                                                cols="30"
                                                rows="10"
                                                placeholder="Enter Your Description"
                                                v-model="description"
                                                class="form-control"
                                                required
                                            ></textarea>
                                        </div>
                                        <div
                                            class="spinner-border"
                                            id="visibleSpinner"
                                            role="status"
                                            style="
                                                font-size: 10px;
                                                width: 20px;
                                                height: 20px;
                                                display: none;
                                            "
                                        >
                                            <span class="visually-hidden"
                                                >Loading...</span
                                            >
                                        </div>
                                        <button
                                            type="submit"
                                            v-on:click="updateCategory"
                                            id="updateCategory"
                                            class="btn btn-primary me-2 -flex float-end"
                                        >
                                            Update Category
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--=================== Include Footer ===================-->
                <Footer />
                <!--=================== Include Footer ===================-->
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- <Header />
    <Sidebar/> -->
</template>

<script>
import Header from "../layout/Header.vue";
import Sidebar from "../layout/Sidebar.vue";
import axios from "axios";
import { useRoute } from "vue-router";

export default {
    name: "EditCategory",
    components: {
        Header,
        Sidebar,
    },
    data() {
        return {
            name: "",
            description: "",
            id: "",
        };
    },
    mounted() {
        const route = useRoute();
        const categoryId = route.params.id;
        axios({
            url: `/api/edit-category/${categoryId}`,
            method: "get",
        }).then((result) => {
            this.name = result.data.cat_name;
            this.description = result.data.cat_des;
            this.id = result.data.id;
        });
    },
    methods: {
        updateCategory(e) {
            e.preventDefault();

            const updateButton = document.getElementById("updateCategory");
            if (!updateButton) return;

            const spinner = document.createElement("div");
            spinner.className = "spinner-border";
            spinner.style.fontSize = "10px";
            spinner.style.width = "20px";
            spinner.style.height = "20px";
            spinner.style.marginRight = "5px";
            updateButton.textContent = "";
            updateButton.appendChild(spinner);
            updateButton.disabled = true;

            var formData = new FormData();
            formData.append("cat_name", this.name);
            formData.append("cat_des", this.description);
            formData.append("id", this.id);

            axios({
                url: "/updateCategory",
                method: "POST",
                data: formData,
            })
                .then((result) => {
                    if (result.data.message === 200) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Category updated successfully",
                            showConfirmButton: false,
                            timer: 1500,
                            customClass: {
                                popup: "custom-alert-popup",
                            },
                        });
                    }
                    updateButton.textContent = "Update Category";
                    updateButton.disabled = false;
                })
                .catch((error) => {
                    console.log(error);
                    updateButton.textContent = "Update Category";
                    updateButton.disabled = false;
                });
        },
    },
};
</script>
