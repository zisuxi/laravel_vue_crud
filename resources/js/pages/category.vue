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
                        <div class="col-md-6"><strong>Category</strong></div>
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
                                    <h4 class="card-title">Add Category</h4>
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
                                                v-model="cat_name"
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
                                            <textarea
                                                id=""
                                                cols="30"
                                                rows="10"
                                                placeholder="Enter Your Description"
                                                v-model="cat_des"
                                                class="form-control"
                                                required
                                            ></textarea>
                                        </div>

                                        <button
                                            type="submit"
                                            v-on:click="addCategory"
                                            class="btn btn-primary me-2 -flex float-end"
                                        >
                                            Add Category
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
import Swal from "sweetalert2/dist/sweetalert2.js";

export default {
    name: "Category",
    components: {
        Header,
        Sidebar,
    },
    data() {
        return {
            cat_name: "",
            cat_des: "",
        };
    },
    methods: {
        addCategory(e) {
            e.preventDefault();
            if (this.cat_des === "" && this.cat_name === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please provide category name and description!",
                });
                return;
            }
            var formData = new FormData();
            formData.append("cat_name", this.cat_name);
            formData.append("cat_des", this.cat_des);
            axios({
                url: `category`,
                method: "POST",
                data: formData,
            }).then(function (res) {
                res.status === 200
                    ? Swal.fire({
                          position: "top-end",
                          icon: "success",
                          title: "Category inserted successfully",
                          showConfirmButton: false,
                          timer: 1500,
                          customClass: {
                              popup: "custom-alert-popup",
                          },
                      })
                    : Swal.fire({
                          icon: "error",
                          title: "Oops...",
                          text: "Something went wrong!",
                      });
            });
        },
    },
};
</script>
