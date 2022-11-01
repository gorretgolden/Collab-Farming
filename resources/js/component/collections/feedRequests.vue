<template>
  <div class="d-flex" v-cloak>
    <side-navigation/>
    <div id="page-content-wrapper">

        <nav
          class="navbar navbar-expand-lg border-bottom shadow-sm"
          style="background: white"
         >
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
  
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul
              class="navbar-nav ml-auto mt-2 mt-lg-0"
              style="position: absolute; right: 5%"
            >
              <li class="nav-item active">
                <a class="nav-link username-link text-muted mt-1" href="#"
                  >Welcome {{ user.name }}</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" style="font-size: 22px"
                  ><i class="fa fa-bell" style="color: #999999"></i
                ></a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  @click="openOrCloseMenu"
                  href="#"
                  style="font-size: 22px"
                  ><i class="fa fa-bars" style="color: #999999"></i
                ></a>
                <menu-list />
              </li>
            </ul>
          </div>
        </nav> 
        <!-- egg weights tab -->
        <div class="w-100 bg-light">
            <div class="row">
                <div class="bg-light w-85 pt-2 h-100 ml-3 mt-2 ">
            <div class="h-15 vw-90 d-flex flex-row align-items-center bg-light">
            <nav class="d-flex flex-col justify-content-evenly">
                <ul class="list-inline mt-5 ml-5 pl-5">
                  <li class="list-inline-item">
                    <router-link to="/delivery-weights" class="nav-link">
                      <h5>Egg Delivery Weights</h5> 
                    </router-link> 
                </li>
                <li class="list-inline-item ml-5">
                    <router-link to="/feedrequests" class="nav-link">
                        <h5>Feed Requests</h5>
                    </router-link>
                </li>
                </ul>
            </nav>
            </div>
            </div>
            </div>
         
  
     <div class="bg-light w-85 pt-2 h-100  mt-2 ">
     <div class="h-auto mt-4 pt-4 w-90 mx-5 mr-3 px-5 bg-white">

      <table class="table">
           <thead class="thead-light">
              <tr>
                        <th>FARMER</th>
                        <th>REQUEST</th>
                        <th>CREATED</th>
                        <th>STATUS</th>
              </tr>
          </thead>

          <tbody>
              <tr v-for="egg in eggRequests" :key="egg.id">
                  <td
                      class="text-primary"
                      style="cursor: pointer"
                      @click="toggleApprove(egg)"
                  >
                      {{ egg?.farmer?.name }}
                  </td>

                  <!-- <td v-if="egg">
                     {{ egg.quantity }} {{ egg.quantity_type }},
                       {{ egg.center.name }} on
                       {{egg.delivery_date}} between
                      {{ egg.delivery_start_time }} and
                      {{ egg.delivery_end_time }} 
                  </td> -->

                   <td>
                      <span v-for="sup in egg.farm_requests" :key="sup.id">
                          {{ sup.request_quantity }} ,
                          {{ sup.request_input }}
                      </span>
                  </td> 

                  <td>{{ formatDate(egg?.created_at) }}</td>

                    <td >
                    <span v-if="egg.status === 'confirmed'" style="color:#dc2626">
                        Pending Delivery
                    </span>
                    <span
                      v-else-if="egg.status === 'declined'"
                      :style="{ color: formatStatus(egg.status) }"
                  >
                      Declined 
                </span>

                  <span v-else :style="{ color: formatStatus(egg.status) }">
                      Delivered
                  </span> 
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
                <div class="modal-body" style="padding: 40px 80px">
                                <h4 class="text-center">
                                    Complete the Delivery
                                </h4>
                               <p class="text-center">To {{ clickedReq?.farmer?.name }} </p> 
                               <hr>
                               <form>
                                <p class="text-center">
                                    Request was for
                                </p>
                                <h2 class="text-center" v-for="sup in clickedReq?.farm_requests" :key="sup.id">
                                        {{ sup.request_quantity }}
                                        {{ sup.request_input }}
                                </h2>
                                                       
                                    <div
                                    
                                    >
                                        <button
                                            @click.prevent="complete(clickedReq?.id)"
                                            type="submit"
                                            class="cp-btn cp-btn-g-primary mt-5 ml-9 mb-2 mx-9"
                                            style="margin-left:21%;color:white"
                                        >
                                            <span style="margin-right: 0%;color:white"
                                                ><i
                                                    v-if="isLoading"
                                                    class="fa fa-spinner fa-spin"
                                                ></i></span
                                            >COMPLETE DELIVERY
                                        </button>
                                    </div>
                                  </form>
                            </div>
              </div>
          </div>
      </div>
  </div>
</div>
</div>
</div>
</div>
</template>

<script>
import SideNavigation from ".././Layout/agentLayout/sideNavigation.vue";
import menuList from ".././Layout/agentLayout/menuList.vue";
import Request from ".././mixins/requestHelper";
import IziToast from "../mixins/IziToast";
import Swal from "sweetalert2";

import moment from "moment";

export default {
  name: "feed-requests",


  mixins: [IziToast],

  data() {
      return {
          isLoading: false,
          user: {},
          bulkingCenterList: [],
          eggRequests: [],
          details: {},
          emails: [],
          allEmails: [],
          next_link: `/api/admin/accounts/egg-requests/${this.type}`,
          isLoading: false,
          shouldLoad: true,
          quantityType: "trays",
          step: 1,
          deliveryDate: "",
          deliveryStartTime: "",
          deliveryEndTime: "",
          bulkingCenter: "",
                clickedReq: {},
          withEdits: false,
          newDeliveryDate: "",
          newDeliveryStartTime: "",
          newDeliveryEndTime: "",
      };
  },
  components: { SideNavigation, menuList },


  mounted() {
      let app = this;

      app.getEggRequests();
      app.getBulkingCenters();

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
    getBulkingCenters() {
            let app = this;
            Request.getMethod("/api/farmer/bulking-centers")
                .then((result) => {
                    console.log(result.data);
                    if (result.data.response === "success") {
                        app.bulkingCenterList = result.data.bulking_centers;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    complete(id){
        const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-2'
                  },
                  buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                  title: 'Confirm Delivery',
                  html: " <small>You are about to confirm this delivery ?</small>",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, Confirm!',
                  cancelButtonText: 'cancel!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.isConfirmed) {
                        axios.post(`/api/approveDelivery/${id}`)
                        Swal.fire({
                            title: "Confirmed",
                            icon: "success",
                            html: '<p style="font-size: 14px">The delivery has been successfully delivered.</p>',
                            showCloseButton: false,
                            showCancelButton: false,
                            focusConfirm: true,
                            confirmButtonText: "OK",
                            confirmButtonColor: "#43ad60",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            closeOnClickOutside: false,
                            
                            })
                     
                  } 
                  this.getEggRequests();

                })
                $("#eggDeliveryModal").modal("hide");  

            


    },
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

          Request.getMethod("/api/admin/accounts/egg-requests-collector")
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
