<template>
    <div class="container-scroller">
        <Header />
        <div class="container-fluid page-body-wrapper">
            <Sidebar />
            <div class="main-panel">
                <div
                    class="content-wrapper"
                    style="background-color: rgb(233 238 247)"
                >
                    <div class="row mt-2 p-1">
                        <div class="col-md-6" style="font-size: 21px">
                            <strong> Manage Category</strong>
                        </div>
                        <div class="col-md-6">
                            <router-link
                                to="/add-category"
                                class="btn btn-primary float-end"
                            >
                                Add Category
                            </router-link>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-striped table-hover"
                                        >
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Category Name</th>
                                                    <th>
                                                        Category Description
                                                    </th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="(
                                                        category, index
                                                    ) in categories.data"
                                                    :key="category.id"
                                                >
                                                    <td>
                                                        {{
                                                            (pagination.current_page -
                                                                1) *
                                                                pagination.per_page +
                                                            index +
                                                            1
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{ category.cat_name }}
                                                    </td>
                                                    <td class="word-wrap-cell">
                                                        {{ category.cat_des }}
                                                    </td>
                                                    <td>
                                                        <i
                                                            @click="
                                                                deleteRecord(
                                                                    category.id
                                                                )
                                                            "
                                                            class="fa-solid fa-trash"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom"
                                                            title=" Delete this Category"
                                                            style="
                                                                color: #6666ff;
                                                                font-size: 17px;
                                                                cursor: pointer;
                                                                margin-right: 11px;
                                                            "
                                                        ></i>
                                                        <router-link
                                                            :to="`/editCategory/${category.id}`"
                                                        >
                                                            <i
                                                                class="fa-solid fa-pen"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="bottom"
                                                                title=" Edit this Category"
                                                                style="
                                                                    color: #6666ff;
                                                                    font-size: 17px;
                                                                    cursor: pointer;
                                                                "
                                                            ></i>
                                                        </router-link>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br />
                                        <!-- Pagination Controls -->
                                        <pagination
                                            class="float-end"
                                            style=""
                                            :data="categories"
                                            @pagination-change-page="getallData"
                                        ></pagination>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <Footer /> -->
            </div>
        </div>
    </div>
</template>

<script>
import Header from "../layout/Header.vue";
import Sidebar from "../layout/Sidebar.vue";
import axios from "axios";
import { Bootstrap5Pagination } from "laravel-vue-pagination";
import Swal from "sweetalert2/dist/sweetalert2.js";

export default {
    components: {
        Header,
        Sidebar,
        Pagination: Bootstrap5Pagination,
    },
    data() {
        return {
            categories: {
                data: [], // Data for the current page
                last_page: 1, // Total number of pages
            },
            pagination: {
                current_page: 1,
                per_page: 10,
            },
            error: null,
        };
    },
    mounted() {
        this.getallData();
    },
    methods: {
        getallData(page = 1) {
            axios({
                url: `api/getCategory?page=${page}`, // Ensure the correct API endpoint
                method: "GET",
            })
                .then((response) => {
                    this.categories = response.data;
                    this.pagination.current_page = response.data.current_page;
                    this.pagination.per_page = response.data.per_page;
                })
                .catch((error) => {
                    this.error = error; // Save error to data property
                    console.error(error);
                });
        },
        deleteRecord(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "rgb(147 15 13)",
                cancelButtonColor: "#2e422b",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios({
                        url: `category/${id}`,
                        method: "DELETE",
                    })
                        .then((result) => {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your record has been deleted.",
                                icon: "success",
                            });
                            this.getallData(this.pagination.current_page); // Refresh current page data
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            });
        },
    },
};
</script>

<style scoped>
.word-wrap-cell {
    max-width: 200px; /* Adjust based on your layout */
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
}
</style>
