<template>
    <section class="mt-4">
        <div class="card-body" style="background-color:white">

        <table class="table table-sm unicef-activities-table">
            <thead>
                <tr>
                    <th>FARMER</th>
                    <th>COLLECTION CENTRE/SCHEDULE</th>
                    <th>CREATED</th>
                    <th>STATUS</th>
                </tr>
            </thead>

            <tbody
              
            >
                <tr v-for="egg in eggRequests" :key="egg.id">
                    <td
                        class="text-primary"
                        style="cursor: pointer"
                        @click="toggleApprove(egg)"
                    >
                        {{ egg?.farmer?.name }}
                    </td>

                    <td v-if="egg">
                       {{ egg.quantity }} {{ egg.quantity_type }},
                         {{ egg?.center?.name }} on
                         {{egg.delivery_date}} between
                        {{ egg.delivery_start_time }} and
                        {{ egg.delivery_end_time }} 
                    </td>

                     <td v-else>
                        <span v-for="sup in egg.farm_supplies" :key="sup.id">
                            {{ sup.product_quantity }} -
                            {{ sup.product.inputs }}
                        </span>
                    </td> 

                    <td>{{ formatDate(egg?.created_at) }}</td>

                    <td
                        v-if="egg.status === 'pending'"
                        :style="{ color: formatStatus(egg.status) }"
                    >
                        Pending Review
                    </td>

                    <td
                        v-else-if="egg.status === 'declined'"
                        :style="{ color: formatStatus(egg.status) }"
                    >
                        Declined
                    </td>

                    <td v-else :style="{ color: formatStatus(egg.status) }">
                        Scheduled
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal To Initiate Delivery Request-->
        <div
            class="modal fade"
            id="eggDeliveryModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-lg"
                role="document"
            >
                <div class="modal-content">
                    <div class="modal-body" style="padding: 10px 80px">
                        <h4 class="text-center">Schedule Delivery</h4>

                        <p class="text-center">
                            by {{ clickedReq?.farmer?.name }}
                        </p>

                        <hr />

                        <form v-if="!withEdits">
                            <div>
                                <label for="quantity"
                                    >Quantity to Deliver</label
                                >

                                <h2
                                    v-if="clickedReq?.quantity_type === 'trays'"
                                >
                                    {{ clickedReq?.quantity }}
                                    {{ clickedReq?.quantity_type }}
                                </h2>

                                <div v-else>
                                    <h4
                                        v-for="sup in clickedReq?.farm_supplies"
                                        :key="sup.id"
                                    >
                                        {{ sup.product_quantity }} -
                                        {{ sup.product.inputs }}
                                    </h4>
                                </div>
                            </div>

                            <hr />

                            <div>
                                <label>Delivery Date</label>

                                <h2>
                                    {{ formatDate(clickedReq?.delivery_date) }}
                                    between
                                    {{ clickedReq?.delivery_start_time }} &
                                    {{ clickedReq?.delivery_end_time }}
                                </h2>
                            </div>

                            <hr />

                            <div>
                                <label>Bulking Center</label>

                                <h2>
                                    {{ clickedReq?.center?.name }}
                                </h2>
                            </div>

                            <hr />

                            <div class="d-flex justify-content-center py-4">
                                <button
                                    @click.prevent="editRequest"
                                    type="submit"
                                    class="cp-btn cp-btn-g-primary mt-2 mb-2 mx-2"
                                    style="
                                        padding: 1rem 4rem;
                                        background-color: #4b5563;
                                        color: #fff;
                                    "
                                    :disabled="isLoading">
                                    EDIT
                                </button>

                                <button
                                    @click.prevent="acceptEggDelivery"
                                    type="submit"
                                    class="cp-btn cp-btn-g-primary mt-2 mb-2 mx-2"
                                    style="padding: 1rem 4rem"
                                    :disabled="isLoading"
                                >
                                    <span style="margin-right: 5%"
                                        ><i
                                            v-if="isLoading"
                                            class="fa fa-spinner fa-spin"
                                        ></i></span
                                    >ACCEPT
                                </button>
                            </div>
                        </form>

                        <form v-else>
                            <div v-if="clickedReq?.quantity_type === 'trays'">
                                <label for="quantity"
                                    >Quantity to Deliver</label
                                >

                                <h2>
                                    {{ clickedReq?.quantity }}
                                    {{ clickedReq?.quantity_type }}
                                </h2>
                            </div>

                            <div v-else>
                                <label>Edit Request</label>

                                <div
                                    v-for="sup in clickedReq?.farm_supplies"
                                    :key="sup.id"
                                    class="row py-0 my-0 mb-2"
                                >
                                    <div class="form-group col-3 py-0 my-0">
                                        <input
                                            type="number"
                                            class="form-control py-0 my-0"
                                            id="requestQuantity"
                                            aria-describedby="requestQuantity"
                                            min="1"
                                            placeholder="0"
                                            v-model="sup.product_quantity"
                                        />
                                    </div>

                                    <div class="form-group col-9 py-0 my-0">
                                        <p class="mt-1">
                                            {{ sup.product.inputs }}
                                        </p>

                                        <!-- <select
                                            class="form-control py-0 my-0"
                                            id="exampleFormControlSelect1"
                                            v-model="req.requestType"
                                        >
                                            <option value="" disabled>
                                                Select Product Input
                                            </option>

                                            <option
                                                v-for="input of inputs"
                                                :key="input.id"
                                                :value="input.id"
                                            >
                                                {{ input.inputs }}
                                            </option>
                                        </select> -->
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <div
                                v-if="clickedReq?.quantity_type === 'trays'"
                                class="d-flex justify-content-between"
                            >
                                <div>
                                    <div class="form-group">
                                        <label for="deliveryDate" class=""
                                            >Delivery Date</label
                                        >

                                        <div class="">
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="deliveryDate"
                                                placeholder="Date"
                                                v-model="newDeliveryDate"
                                                :min="minimumDate()"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="form-group">
                                        <label for="startTime" class=""
                                            >Delivery Times (Select
                                            range)</label
                                        >

                                        <div class="row p-0 m-0">
                                            <div class="mr-2">
                                                <select
                                                    class="form-control"
                                                    id="exampleFormControlSelect1"
                                                    v-model="
                                                        newDeliveryStartTime
                                                    "
                                                >
                                                    <option value="" disabled>
                                                        Between
                                                    </option>

                                                    <option
                                                        v-for="(
                                                            item, index
                                                        ) in knownTime"
                                                        :key="item"
                                                        :value="
                                                            knownTime[index]
                                                        "
                                                    >
                                                        {{ knownTime[index] }}
                                                    </option>
                                                </select>
                                            </div>

                                            <span>-</span>

                                            <div class="ml-2">
                                                <select
                                                    class="form-control"
                                                    id="exampleFormControlSelect1"
                                                    v-model="newDeliveryEndTime"
                                                >
                                                    <option value="" disabled>
                                                        And
                                                    </option>

                                                    <option
                                                        v-for="(
                                                            item, index
                                                        ) in knownTime"
                                                        :key="item"
                                                        :value="
                                                            knownTime[index]
                                                        "
                                                    >
                                                        {{ knownTime[index] }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-else>
                                <div>
                                    <label>Delivery Date</label>

                                    <h2>
                                        {{
                                            formatDate(
                                                clickedReq?.delivery_date
                                            )
                                        }}
                                        between
                                        {{ clickedReq?.delivery_start_time }} &
                                        {{ clickedReq?.delivery_end_time }}
                                    </h2>
                                </div>
                            </div>

                            <hr />

                            <div>
                                <label for="quantity">Bulking Center</label>

                                <h2>
                                    {{ clickedReq?.center?.name }}
                                </h2>
                            </div>

                            <hr />

                            <div class="d-flex justify-content-center py-4">
                                <button
                                    @click.prevent="cancelRequest"
                                    type="submit"
                                    class="cp-btn cp-btn-g-primary mt-2 mb-2 mx-2"
                                    style="
                                        padding: 1rem 4rem;
                                        background-color: #4b5563;
                                        color: #fff;
                                    "
                                    :disabled="isLoading"
                                >
                                    CANCEL
                                </button>

                                <button
                                    @click.prevent="acceptEggDelivery"
                                    type="submit"
                                    class="cp-btn cp-btn-g-primary mt-2 mb-2 mx-2"
                                    style="padding: 1rem 4rem"
                                    :disabled="isLoading"
                                >
                                    <span style="margin-right: 5%"
                                        ><i
                                            v-if="isLoading"
                                            class="fa fa-spinner fa-spin"
                                        ></i></span
                                    >ACCEPT
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</template>

<script>
import Request from "../mixins/requestHelper";
import IziToast from "../mixins/IziToast";
import authToken from "../mixins/authToken";

import moment from "moment";

export default {
    name: "EggDeliveryRequests",

    props: ["type"],

    mixins: [IziToast, authToken],

    data() {
        return {
            isLoading: false,
            eggRequests: [],
            details: {},

            emails: [],
            allEmails: [],
            next_link: `/api/admin/accounts/egg-requests/${this.type}`,
            isLoading: false,
            shouldLoad: true,

            step: 1,
            deliveryDate: "",
            deliveryStartTime: "",
            deliveryEndTime: "",
            bulkingCenter: "",
            knownTime: [
                "09:00",
                "09:30",
                "10:00",
                "10:30",
                "11:00",
                "11:30",
                "12:00",
                "12:30",
                "13:00",
                "13:30",
                "14:00",
                "14:30",
                "15:00",
                "15:30",
                "16:00",
                "16:30",
                "17:00",
            ],

            clickedReq: {},
            withEdits: false,
            newDeliveryDate: "",
            newDeliveryStartTime: "",
            newDeliveryEndTime: "",
        };
    },

    mounted() {
        let app = this;

        app.getEggRequests();
        // getEggDeliveryRequests();

        app.getData(app.next_link);
        $("#email-logs-content").scroll(function () {
            if (
                $(this)[0].offsetHeight + $(this).scrollTop() >=
                $(this)[0].scrollHeight - 50
            ) {
                if (app.shouldLoad) {
                    setTimeout(function () {
                        app.getData(app.next_link);
                    }, 2000);
                }
            }
        });
    },

    methods: {
        //
        // Accept egg delivery request
    //   getEggDeliveryRequests() {
    //   let app = this;
    //   Request.getMethod("/api/admin/accounts/egg-requests")
    //     .then((data) => {
          
    //       app.details = data.data;

    //     console.log(app.details);
    //     })
    //     .catch((error) => {
    //       console.log(error.response);
    //     });
    // },
        acceptEggDelivery() {
            let app = this;

            // If with edits, validate that new date and time have been specified
            if (app.withEdits && app.type === "eggs") {
                if (app.newDeliveryDate.trim() === "") {
                    return app.showErrorMessage("Enter delivery date");
                }

                if (app.newDeliveryStartTime.trim() === "") {
                    return app.showErrorMessage("Enter delivery start time");
                }

                if (app.newDeliveryEndTime.trim() === "") {
                    return app.showErrorMessage("Enter delivery end time");
                }
            }

            app.isLoading = true;

            const formData = new FormData();
            formData.append("id", app.clickedReq.id);
            formData.append("withEdits", app.withEdits);
            formData.append("newDeliveryDate", app.newDeliveryDate);
            formData.append("newDeliveryStartTime", app.newDeliveryStartTime);
            formData.append("newDeliveryEndTime", app.newDeliveryEndTime);

            // This option is available when dealing with farm inputs
            formData.append(
                "farmRequests",
                JSON.stringify(app.clickedReq?.farm_supplies)
            );

            $.ajax({
                processData: false,
                contentType: false,
                enctype: "multipart/form-data",
                type: "post",
                url: `/api/admin/accounts/accept-delivery`,
                headers: {
                    Authorization: `Bearer ${authToken()}`,
                },
                data: formData,
                success(data) {
                    console.log("");
                    console.log("");
                    console.log("");
                    console.log(data);

                    app.clickedReq = {};
                    $("#eggDeliveryModal").modal("toggle");

                    app.showSuccessMessage(data.message);
                    app.isLoading = false;

                    app.emails = [];
                    app.allEmails = [];
                    app.getData(`/api/admin/accounts/egg-requests/${app.type}`);

                    app.withEdits = false;
                },
                error(e) {
                    console.log(e);
                    app.isLoading = false;
                    app.showErrorMessage("Failed to accept delivery request");
                },
            });
        },

        //
        // Edit Egg delivery request
        editRequest() {
            this.withEdits = true;
        },

        //
        // Cancel edit Egg delivery request
        cancelRequest() {
            this.withEdits = false;
            this.newDeliveryDate = "";
            this.newDeliveryStartTime = "";
            this.newDeliveryEndTime = "";
        },

        //
        // Toggle Approve request
        toggleApprove(egg) {
            console.log(egg);
            this.clickedReq = egg;
            $("#eggDeliveryModal").modal("toggle");
        },

        //
        // Get egg requests
        getEggRequests() {
            let app = this;

            Request.getMethod("/api/admin/accounts/egg-requests")
                .then((result) => {
                    console.log(result.data.egg_requests);
                    if (result.data.response === "success") {
                        app.eggRequests = result.data.egg_requests;
                    }
                })
                .catch((error) => {
                    console.log(error);
                    app.showErrorMessage("Failed to get egg requests");
                });
        },

        getData(link) {
            let app = this;
            app.isLoading = false;

            Request.getMethod(link)
                .then((response) => {
                    console.log("");
                    console.log("");
                    console.log("");
                    console.log(response.data.egg_requests.data[0]);

                    // return;
                    app.allEmails.push(...response.data.egg_requests.data);

                    app.emails = [...new Set(app.allEmails)];
                    if (response.data.egg_requests.next_page_url != null) {
                        app.next_link = data.next_page_url;
                        app.isLoading = true;
                    } else {
                        app.shouldLoad = false;

                        // alert("Ok")
                    }
                })
                .catch((error) => {
                    console.log(error);
                    //.showErrorMessage("Error Occured ");
                });
        },

        //
        // Minimum Date
        minimumDate() {
            const dateObj = new Date();
            let month = dateObj.getUTCMonth() + 1; //months from 1-12
            const day = dateObj.getUTCDate(); // day today
            const year = dateObj.getUTCFullYear();

            month = month < 10 ? `0${month}` : month;

            const today = year + "-" + month + "-" + day;

            return today;
        },

        formatDate(date) {
            return moment(date).format("DD MMM YYYY");
        },

        formatStatus(status) {
            if (status === "pending") {
                return "#71717a";
            }

            if (status === "declined") {
                return "#dc2626";
            }

            return "#16a34a";
        },
    },
};
</script>

<style></style>
