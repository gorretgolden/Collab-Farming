<template>
    <section>
        <div class="d-flex" v-cloak>
            <SideNavigation />

            <div id="page-content-wrapper" class="card-body" >
                <AccountHeader />

                <div class="content-padding" style="background-color:white">
                    <nav
                        class="nav nav-tab"
                        style="height: 55px; margin-bottom: -1rem"
                        id="unicef-tabs-cit"
                    >
                        <a
                            @click.prevent="changeTab(0)"
                            data-tab="0"
                            href="#"
                            style="color: #333; padding: 0.5rem 0 !important"
                            class="nav-item nav-link"
                            :class="{ active: tab === 0 }"
                            >Egg Delivery Requests</a
                        >
                    </nav>
                    <div>

                    <table class="table table-sm mt-4 bg-white">
                        <thead>
                            <tr>
                                <th>FARMER</th>
                                <th>DELIVERY</th>
                                <th>1 (# OF TRAYS, AVG WEIGHT, AMOUNT)</th>
                                <th>2 (# OF TRAYS, AVG WEIGHT, AMOUNT)</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>

                        <tbody  v-for="egg in eggRequests" :key="egg.id">
                         
                            <tr>
                                <td
                                    class="text-primary"
                                    style="cursor: pointer"
                                    @click="toggleTimeline()"
                                >
                                {{ egg?.farmer?.name }}
                                </td>

                                <td>400 Trays</td>

                                <td v-for="x in egg.weights" v-bind:key="x">
                                    {{x?.actual_no_of_trays}} Trays {{x?.avg_weight_1}}KG/Tray UGX {{x?.total_price}}
                                </td>

                                <td v-for="y in egg.secondweights" v-bind:key="y">
                                    {{y?.actual_no_of_trays2}} Trays {{y?.avg_weight_2}}KG/Tray UGX {{y?.total_price2}}
                                </td>

                                <td
                                    class="text-primary"
                                    style="cursor: pointer"
                                    @click.prevent="confirmPayment(egg.id)"
                                >
                                    <span v-for="p in egg.payments" v-bind:key="p"> 
                                    <span v-if="p.status === 'pending'" style="color:blue">
                                     Pay </span>
                                    <span v-else-if="p.status === 'confirmed'" style="color:green">Confirmed</span>
                                    </span>
                                </td>
                            </tr>

                       
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

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
                        <button    @click.prevent="editRequest"
                            type="submit"
                            class="cp-btn cp-btn-g-primary mt-2 mb-2 mx-2"
                            style="padding: 1rem 4rem;
                                background-color: #4b5563;
                                color: #fff;"
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

        <!-- Modal To Initiate Delivery Request-->
        <div
            class="modal fade"
            id="requestTimelineModal"
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

                        <p class="text-center">Transaction history</p>

                        <div style="max-height: 400px; overflow: scroll">
                            <div class="border-left ml-2">
                                <div class="d-flex">
                                    <span
                                        style="
                                            width: 10px;
                                            height: 10px;
                                            background-color: #f59e0b;
                                            border-radius: 10px;
                                            position: relative;
                                            left: -5px;
                                        "
                                    ></span>
                                    <p class="ml-3">Mon, 23 Aug</p>
                                </div>

                                <div class="border p-4 m-4">
                                    <h5 class="" style="color: #1e3a8a">
                                        1st Weighing
                                    </h5>

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            Indicated Number Of Trays: 130
                                        </div>

                                        <div>
                                            Suggested bulking center: Kampala
                                            Central 1
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div>Delivery Request Accepted?</div>

                                        <div>Between 10:00 and 13:00</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-left ml-2">
                                <div class="d-flex">
                                    <span
                                        style="
                                            width: 10px;
                                            height: 10px;
                                            background-color: #f59e0b;
                                            border-radius: 10px;
                                            position: relative;
                                            left: -5px;
                                        "
                                    ></span>
                                    <p class="ml-3">Mon, 23 Aug</p>
                                </div>

                                <div class="border p-4 m-4">
                                    <h5 class="" style="color: #1e3a8a">
                                        1st Weighing
                                    </h5>

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            Indicated Number Of Trays: 130
                                        </div>

                                        <div>
                                            Suggested bulking center: Kampala
                                            Central 1
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div>Delivery Request Accepted?</div>

                                        <div>Between 10:00 and 13:00</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-left ml-2">
                                <div class="d-flex">
                                    <span
                                        style="
                                            width: 10px;
                                            height: 10px;
                                            background-color: #f59e0b;
                                            border-radius: 10px;
                                            position: relative;
                                            left: -5px;
                                        "
                                    ></span>
                                    <p class="ml-3">Mon, 23 Aug</p>
                                </div>

                                <div class="border p-4 m-4">
                                    <h5 class="" style="color: #1e3a8a">
                                        1st Weighing
                                    </h5>

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            Indicated Number Of Trays: 130
                                        </div>

                                        <div>
                                            Suggested bulking center: Kampala
                                            Central 1
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div>Delivery Request Accepted?</div>

                                        <div>Between 10:00 and 13:00</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-left ml-2">
                                <div class="d-flex">
                                    <span
                                        style="
                                            width: 10px;
                                            height: 10px;
                                            background-color: #f59e0b;
                                            border-radius: 10px;
                                            position: relative;
                                            left: -5px;
                                        "
                                    ></span>
                                    <p class="ml-3">Mon, 23 Aug</p>
                                </div>

                                <div class="border p-4 m-4">
                                    <h5 class="" style="color: #1e3a8a">
                                        1st Weighing
                                    </h5>

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            Indicated Number Of Trays: 130
                                        </div>

                                        <div>
                                            Suggested bulking center: Kampala
                                            Central 1
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div>Delivery Request Accepted?</div>

                                        <div>Between 10:00 and 13:00</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-left ml-2">
                                <div class="d-flex">
                                    <span
                                        style="
                                            width: 10px;
                                            height: 10px;
                                            background-color: #f59e0b;
                                            border-radius: 10px;
                                            position: relative;
                                            left: -5px;
                                        "
                                    ></span>
                                    <p class="ml-3">Mon, 23 Aug</p>
                                </div>

                                <div class="border p-4 m-4">
                                    <h5 class="" style="color: #1e3a8a">
                                        1st Weighing
                                    </h5>

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            Indicated Number Of Trays: 130
                                        </div>

                                        <div>
                                            Suggested bulking center: Kampala
                                            Central 1
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div>Delivery Request Accepted?</div>

                                        <div>Between 10:00 and 13:00</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-left ml-2">
                                <div class="d-flex">
                                    <span
                                        style="
                                            width: 10px;
                                            height: 10px;
                                            background-color: #f59e0b;
                                            border-radius: 10px;
                                            position: relative;
                                            left: -5px;
                                        "
                                    ></span>
                                    <p class="ml-3">Mon, 23 Aug</p>
                                </div>

                                <div class="border p-4 m-4">
                                    <h5 class="" style="color: #1e3a8a">
                                        1st Weighing
                                    </h5>

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            Indicated Number Of Trays: 130
                                        </div>

                                        <div>
                                            Suggested bulking center: Kampala
                                            Central 1
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div>Delivery Request Accepted?</div>

                                        <div>Between 10:00 and 13:00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import SideNavigation from "../Layout/accountLayout/sideNavigation.vue";
import AccountHeader from "../Layout/accountLayout/header.vue";
import Request from "../mixins/requestHelper";


import Swal from "sweetalert2";
import moment from "moment";


import EggRequests from "./EggRequests.vue";
export default {
    name: "PaymentOrders",

    components: { SideNavigation, AccountHeader },

    data() {
        return {
            tab: 0,
            isLoading: false,
            eggRequests: [],
        };
    },
    mounted(){
        let app = this;
        app.getEggRequests();
    },

    methods: {
        //
        // Confirm Payment
        confirmPayment(id) {
            Swal.fire({
                title: "Confirm Payment",
                html: "<p style='font-size: 14px;'>You are about to confirm that this amount has been paid to this farmer for the delivery  <br/><br/> Proceed?</p>",
                icon: "warning",
                reverseButtons: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonColor: "#40af40",
                confirmButtonText: "Yes, Proceed",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(`/api/confirm-payment-accounts/${id}`)
                    app.getEggRequests();

                } else if (result.isDismissed) {
                }
            });
        },
        getEggRequests() {
            let app = this;

            Request.getMethod("/api/admin/accounts/egg-requests-payments")
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

        //
        // Toggle Approve request
        toggleTimeline(egg) {
            console.log(egg);
            this.clickedReq = egg;
            $("#requestTimelineModal").modal("toggle");
        },

        //
        //
        changeTab(t) {
            this.tab = t;
        },
    },
};
</script>

<style></style>
