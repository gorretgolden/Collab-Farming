<template>
    <section>
        <div class="d-flex" v-cloak>
            <SideNavigation />

            <div id="page-content-wrapper">
                <Header/>
                <h4 class="ml-3 my-3">Payment Receipt</h4>

                <div class="card" >
                    <div class="">

                    <table class="table table-sm mt-5 p-5 mx-3 mr-3" style="background-color:white">
                        <thead>
                            <tr>
                                <th>COLLECTION CENTER/SCHEDULE</th>
                                <th>DELIVERED</th>
                                <th>AVG. WEIGHT</th>
                                <th>PRICE</th>
                                <th>AMOUNT DUE</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>

                        <tbody v-for="egg in eggRequests" :key="egg.id">
                            <tr>
                                <td>
                                    {{ egg?.center?.name }} on
                                    {{egg.delivery_date}} between
                                    {{ egg.delivery_start_time }} and
                                    {{ egg.delivery_end_time }} 
                                </td>

                                <td>{{ egg.quantity }} {{ egg.quantity_type }}</td>

                                <td v-for="y in egg.secondweights" v-bind:key="y">{{y?.avg_weight_2}} KG/Tray</td>

                                <td v-for="y in egg.secondweights" v-bind:key="y">UGX {{y?.current_price}}/KG</td>

                                <td v-for="y in egg.secondweights" v-bind:key="y">UGX {{y?.total_price2}}</td>

                                <td
                                    class="text-primary"
                                    style="cursor: pointer"
                                    @click.prevent="confirmPayment(egg.id)"
                                >
                                <span v-for="p in egg.payments" v-bind:key="p"> 
                                    <span v-if="p.farmer_status === 'pending'" style="color:blue">
                                     Pending </span>
                                    <span v-else-if="p.farmer_status === 'confirmed'" style="color:green">Confirmed</span>
                                    </span>
                                   
                                </td>
                            </tr>

                         
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import SideNavigation from "../Layout/farmerLayout/sideNavigation.vue";
import Header from "../Layout/farmerLayout/header.vue";
import Request from "../mixins/requestHelper";

import Swal from "sweetalert2";

export default {
    name: "PaymentOrders",

    components: { SideNavigation, Header },

    data() {
        return {
            tab: 0,
            isLoading: false,
            eggRequests: [],
        };
    },
//     computed:{
//     result(){
//       return parseInt(this.t) * parseFloat(this.weight)/2
//     },
//     weight1(){
//       return parseInt(this.trays) * parseFloat(this.weight)
//     },

//   },
    mounted(){
        let app = this;
        app.getEggRequests();
    },

    methods: {
        //
        // Confirm Payment
        confirmPayment(id) {
            Swal.fire({
                title: "Confirm Receipt",
                html: "<p style='font-size: 14px;'>You are about to confirm this receipt from Pristine Eggs.<br/><br/> Proceed?</p>",
                icon: "warning",
                reverseButtons: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonColor: "#40af40",
                confirmButtonText: "Yes, Receipt",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(`/api/confirm-payment-farmer/${id}`)


                } else if (result.isDismissed) {
                }
            });
        },
        updateInput(id) {
      let app = this;
       {
       
               $.ajax({
                        url: `/api/update-input/${id}`,
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success(data) {
                            Swal.fire({
                            title: "Saved",
                            icon: "success",
                            html: '<p style="font-size: 14px">The Input has successfully been updated.</p>',
                            showCloseButton: false,
                            showCancelButton: false,
                            focusConfirm: true,
                            confirmButtonText: "OK",
                            confirmButtonColor: "#43ad60",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            closeOnClickOutside: false,
                            
                            })
                            
                            app.getInputsList();
                            $("#editInputmodal").modal("hide");
                        },
            });

                         
       
      }
    },
        getEggRequests() {
            let app = this;
            Request.getMethod("/api/admin/accounts/egg-requests-payments-farmer")
                .then((result) => {
                    console.log(result.data.egg_requests);
                    if (result.data.response === "success") {
                        app.eggRequests = result.data.egg_requests;                    }
                })
                .catch((error) => {
                    console.log(error);
                    app.showErrorMessage("Failed to get egg requests");
                });
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
