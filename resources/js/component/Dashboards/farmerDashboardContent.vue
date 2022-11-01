<template>
  <div class="w-100">
    <div class="d-flex justify-content-between my-4">
      <div class="">
        <h5 style="font-weight: 500; color: #333; font-size: 24px">
          Dashboard
        </h5>
      </div>

      <div class="">
        <button
          type="button"
          class="btn btn-primary"
          data-toggle="modal"
          data-target="#requestDeliveryModal"
        >
          Initiate Delivery/Request
        </button>

        <!-- Modal To Initiate Delivery Request-->
        <div
          class="modal fade"
          id="requestDeliveryModal"
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
                <h4 class="text-center">Schedule A Delivery/Request</h4>

                <p class="text-center">
                  Reserve a date/time when you will deliver Eggs
                </p>

                <hr />

                <form v-if="step === 1">
                  <div>
                    <label for="quantity">Quantity to Deliver</label>
                    <div class="row">
                      <div class="form-group col-3">
                        <input
                          type="number"
                          class="form-control"
                          id="quantity"
                          aria-describedby="quantity"
                          min="1"
                          placeholder="0"
                          v-model="quantity"
                        />
                      </div>

                      <div class="form-group col-3">
                        <select
                          class="form-control"
                          id="exampleFormControlSelect1"
                          v-model="quantityType"
                        >
                          <option value="">Select</option>

                          <option value="trays">Trays</option>

                          <!-- <option value="kgs">
                                                        KGs
                                                    </option> -->
                        </select>
                      </div>
                    </div>
                  </div>

                  <div>
                    <label>Request for</label>

                    <div
                      v-for="req in farmRequests"
                      :key="req.id"
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
                          v-model="req.requestQuantity"
                        />
                      </div>

                      <div class="form-group col-7 py-0 my-0">
                        <input
                          type="hidden"
                          :value="
                            requestTypeTextFormat(req.requestType, req.id)
                          "
                        />
                        <select
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
                        </select>
                      </div>

                      <div class="col-md-2 py-0 my-0">
                        <div style="">
                          <button
                            v-if="showAddOrDelete(req.id)"
                            @click="addMoreItems"
                            type="button"
                            class="
                              btn btn-success
                              text-white
                              add-more-btn
                              addMore
                            "
                          >
                            <span class="fa fa-plus text-blue"></span>
                          </button>

                          <button
                            v-else
                            @click="removeItem(req.id)"
                            type="button"
                            class="
                              btn btn-success
                              text-white
                              add-more-btn
                              addMore
                            "
                          >
                            <span
                              class="fa fa-trash text-blue"
                              style="color: red"
                            ></span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="d-flex justify-content-between">
                    <div>
                      <div class="form-group">
                        <label for="deliveryDate" class="">Delivery Date</label>

                        <div class="">
                          <input
                            type="date"
                            class="form-control"
                            id="deliveryDate"
                            placeholder="Date"
                            v-model="deliveryDate"
                            :min="minimumDate()"
                          />
                        </div>
                      </div>
                    </div>

                    <div>
                      <div class="form-group">
                        <label for="startTime" class=""
                          >Delivery Times (Select range)</label
                        >

                        <div class="row p-0 m-0">
                          <div class="mr-2">
                            <select
                              class="form-control"
                              id="exampleFormControlSelect1"
                              v-model="deliveryStartTime"
                            >
                              <option value="" disabled>Between</option>

                              <option
                                v-for="(item, index) in knownTime"
                                :key="item"
                                :value="knownTime[index]"
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
                              v-model="deliveryEndTime"
                            >
                              <option value="" disabled>And</option>

                              <option
                                v-for="(item, index) in knownTime"
                                :key="item"
                                :value="knownTime[index]"
                              >
                                {{ knownTime[index] }}
                              </option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="bulkingCenter">Bulking Center</label>
                    <select
                      class="form-control"
                      id="bulkingCenter"
                      v-model="bulkingCenter"
                    >
                      <option value="">Select</option>
                      <option
                        v-for="c in bulkingCenterList"
                        :key="c.id"
                        :value="c.id"
                      >
                        {{ c.name }}
                      </option>
                    </select>
                  </div>

                  <div class="d-flex justify-content-center py-4">
                    <button
                      @click.prevent="proceed"
                      type="submit"
                      class="cp-btn cp-btn-g-primary mt-2 mb-2 mx-2"
                    >
                      <span style="margin-right: 5%"
                        ><i
                          v-if="isLoading"
                          class="fa fa-spinner fa-spin"
                        ></i></span
                      >PROCEED
                    </button>
                  </div>
                </form>

                <form v-else>
                  <div>
                    <label for="quantity">Quantity to Deliver</label>
                    <div class="row">
                      <div class="form-group col-3">
                        <input
                          type="number"
                          class="form-control"
                          id="quantity"
                          aria-describedby="quantity"
                          min="1"
                          placeholder="0"
                          v-model="quantity"
                          disabled
                        />
                      </div>

                      <div class="form-group col-3">
                        <select
                          class="form-control"
                          id="exampleFormControlSelect1"
                          v-model="quantityType"
                          disabled
                        >
                          <option value="">Select</option>

                          <option value="trays">Trays</option>

                          <!-- <option value="kgs">
                                                        KGs
                                                    </option> -->
                        </select>
                      </div>
                    </div>
                  </div>

                  <div>
                    <label>Request for</label>

                    <div v-for="req in farmRequests" :key="req.id" class="row">
                      <div class="form-group col-3">
                        <input
                          type="number"
                          class="form-control"
                          id="requestQuantity"
                          aria-describedby="requestQuantity"
                          min="1"
                          placeholder="0"
                          v-model="req.requestQuantity"
                          disabled
                        />
                      </div>

                      <div class="form-group col-9">
                        <select
                          class="form-control"
                          id="exampleFormControlSelect1"
                          v-model="req.requestType"
                          disabled
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
                        </select>
                      </div>

                      <!-- <div class="col-md-2">
                                                <div style="">
                                                    <button
                                                        @click="addMoreItems"
                                                        type="button"
                                                        class="btn btn-success text-white add-more-btn addMore"
                                                    >
                                                        <span
                                                            class="fa fa-plus text-blue"
                                                        ></span>
                                                    </button>
                                                </div>
                                            </div> -->
                    </div>
                  </div>

                  <div class="d-flex justify-content-between">
                    <div>
                      <div class="form-group">
                        <label for="deliveryDate" class="">Delivery Date</label>

                        <div class="">
                          <input
                            type="date"
                            class="form-control"
                            id="deliveryDate"
                            placeholder="Date"
                            v-model="deliveryDate"
                            disabled
                          />
                        </div>
                      </div>
                    </div>

                    <div>
                      <div class="form-group">
                        <label for="startTime" class=""
                          >Delivery Times (Select range)</label
                        >

                        <div class="row p-0 m-0">
                          <div class="mr-2">
                            <select
                              class="form-control"
                              id="exampleFormControlSelect1"
                              v-model="deliveryStartTime"
                              disabled
                            >
                              <option value="" disabled>Between</option>

                              <option
                                v-for="(item, index) in knownTime"
                                :key="item"
                                :value="knownTime[index]"
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
                              v-model="deliveryEndTime"
                              disabled
                            >
                              <option value="" disabled>And</option>

                              <option
                                v-for="(item, index) in knownTime"
                                :key="item"
                                :value="knownTime[index]"
                              >
                                {{ knownTime[index] }}
                              </option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="bulkingCenter">Bulking Center</label>
                    <select
                      class="form-control"
                      id="bulkingCenter"
                      v-model="bulkingCenter"
                      disabled
                    >
                      <option value="">Select</option>

                      <option
                        v-for="c in bulkingCenterList"
                        :key="c.id"
                        :value="c.id"
                      >
                        {{ c.name }}
                      </option>
                    </select>
                  </div>

                  <div class="d-flex justify-content-center py-4">
                    <button  @click.prevent="goBack"
                      type="submit"
                      class="cp-btn cp-btn-g-primary mt-2 mb-2 mx-2"
                      style="padding: 1rem 4rem;background-color: #4b5563;color: #fff;"
                      :disabled="isLoading"
                    >
                      BACK
                    </button>

                    <button
                      @click.prevent="saveDeliveryRequest"
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
                      >PROCEED
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12 mb-2">
            <div class="w-100 cp-card cp-dashboard-menu p-4">
              <h5>Eggs Delivered</h5>

              <div class="cp-menu-values">
                <div class="row">
                  <div class="col-md-7">
                    <h2 v-if="farmerdeliveries.weight">{{farmerdeliveries.weight}} KG</h2>
                    <h2 v-else>0 KG</h2>
                  </div>

                  <div class="col-md-5">
                    <div class="cp-menu-chart">
                      <SmallGraph width="100%" id="bar1" color="#f97316" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="w-100 cp-card cp-dashboard-menu p-4">
          <h5>Amount Paid</h5>

          <div class="cp-menu-values">
            <div class="row">
              <div class="col-md-7">
                <h2 v-if="payments.payments">UGX {{payments.payments}}</h2>
                <h2 v-else>UGX 0</h2>
              </div>

              <div class="col-md-5">
                <div class="cp-menu-chart">
                  <SmallGraph width="100%" id="bar2" color="#22c55e" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="w-100 cp-card cp-dashboard-menu p-4">
          <h5>Current Price/KG of Eggs (UGX)</h5>

          <div class="cp-menu-values">
            <div class="row">
              <div class="col-md-7">
                <h2>{{latestPrice["newprice"]}}</h2>
              </div>

              <div class="col-md-5">
                <div class="cp-menu-chart">
                  <SmallGraph width="100%" id="bar3" color="#54d8ff" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-8 cp-card p-3 graph-card mt-3">
        <div class="row">
          <div class="col-md-9">
            <h3
              class="cp-h3 pt-2"
              style="font-size: 15px; font-weight: 400; color: #666"
            >
              Deliveries vs Weighings
            </h3>
          </div>

          <div class="col-md-3">
            <select name="#" id="#" class="form-control">
              <option value="30">Last 30 days</option>
              <option value="6">Last 6 months</option>
              <option value="12">Last Year</option>
              <option value="12">All</option>
            </select>
          </div>
        </div>

        <LineGraph
          class="mt-3"
          id="graph-trend"
          width="100%"
          height="320px"
        ></LineGraph>
      </div>

      <div class="col-md-4 mt-3">
        <div class="row">
          <div class="col-md-12 pt-0">
            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="w-100 cp-card cp-dashboard-menu p-4">
                  <h5>Delivery Requests Made</h5>

                  <div class="cp-menu-values">
                    <div class="row">
                      <div class="col-md-7">
                        <h3>{{ statistics.total }}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="w-100 cp-card cp-dashboard-menu p-4">
              <h5>Delivery Requests Received</h5>

              <div class="cp-menu-values">
                <div class="row">
                  <div class="col-md-7">
                    <h3>{{ statistics.received }}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 pb-0">
            <div class="w-100 cp-card cp-dashboard-menu p-4">
              <h5>Delivery Requests Confirmed</h5>

              <div class="cp-menu-values">
                <div class="row">
                  <div class="col-md-7">
                    <h3>{{ statistics.confirmed }}</h3>
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
import LineGraph from "../common/LineGraph";
import SmallGraph from "../common/SmallGraph";
import IziToast from "../mixins/IziToast";
import Request from "../mixins/requestHelper";
import authToken from "../mixins/authToken";

export default {
  name: "FarmerDashboardContent",

  props: [],

  components: { SmallGraph, LineGraph },

  mixins: [IziToast, authToken],

  data() {
    return {
      statistics: {},
      farmerdeliveries: {},
      payments: {},
      latestPrice: {},
      inputs: [],
      bulkingCenterList: [],
      step: 1,
      isLoading: false,
      quantity: "",
      quantityType: "trays",
      farmRequests: [
        { id: 1, requestQuantity: 0, requestType: 0 },
        // { id: 2, requestQuantity: "", requestType: "" },
        // { id: 3, requestQuantity: "", requestType: "" },
        // { id: 4, requestQuantity: "", requestType: "" },
        // { id: 5, requestQuantity: "", requestType: "" },
      ],
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
    };
  },

  mounted() {
    let app = this;
    app.getStatistics();
    app.getInputs();
    app.getLatestPrice();
    app.getBulkingCenters();
    app.getDeliveries();
    app.getFarmerPayments();
    // btn font color => FFF0E0 || Menu Font Color #FFFFFF || Menu Icon Color #B98855
  },

  computed: {},

  methods: {
    requestTypeTextFormat(id, reqId) {
      let app = this;
      let value =
        app.inputs.filter((s) => s.id == id)[0] != null
          ? app.inputs.filter((s) => s.id == id)[0].inputs
          : "";
      console.log({ value });
      app.farmRequests.filter((s) => {
        if (s.id == reqId) {
          s.requestTypeText = value;
        }
      });
      return value;
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
    getLatestPrice() {
            let app = this;
            Request.getMethod("/api/admin/price/latest")
                .then((result) => {
                 console.log(result.data);
                 app.latestPrice = result.data;
                   
                    // if (result.data.response === "success") {
                    //     app.latestPrice = result.data.latestPrice;
                    // }
                })
                .catch((error) => {
                    console.log(error);
                });
        },

    //
    // Show the delete icon for all except the last item in the list
    showAddOrDelete(id) {
      let app = this;
      // console.log(id);
      const lastItem = app.farmRequests.slice(-1)[0];
      if (id == lastItem.id) {
        return true;
      }

      return false;
    },

    //
    // Remove item from list
    removeItem(id) {
      let app = this;

      const filtered = app.farmRequests.filter((r) => r.id !== id);

      app.farmRequests = filtered;
    },

    //
    // Add more request items to the list
    addMoreItems() {
      let app = this;

      // Get the last item in the list
      const lastItem = app.farmRequests.slice(-1)[0];
      // Validate that it has data before adding another
      if (
        Number(lastItem.requestQuantity) === 0 ||
        Number(lastItem.requestType) === 0
      ) {
        return app.showErrorMessage("Request information is required");
      }
      app.farmRequests.push({
        id: lastItem.id + 1,
        requestQuantity: "",
        requestType: "",
      });
    },

    //
    // Go back
    goBack() {
      this.step--;
    },

    //
    // Validate that all necessary data has been specified
    proceed() {
      let app = this;

      // Validate that it has data before adding another
      const lastItem = app.farmRequests.slice(-1)[0];

      if (Number(app.quantity) === 0) {
        if (
          Number(lastItem.requestQuantity) === 0 ||
          Number(lastItem.requestType) === 0
        ) {
          return app.showErrorMessage(
            "Provide delivery or farm input information"
          );
        }

        if (Number(app.quantity) === 0 && Number(lastItem.requestType) === 0) {
          return app.showErrorMessage(
            "Provide delivery or farm input information"
          );
        }
      }

      if (app.deliveryDate.trim() === "") {
        return app.showErrorMessage("Delivery date is required");
      }
      if (app.deliveryStartTime.trim() === "") {
        return app.showErrorMessage("Select delivery start time");
      }
      if (app.deliveryEndTime.trim() === "") {
        return app.showErrorMessage("Select delivery end time");
      }
      if (!app.bulkingCenter) {
        return app.showErrorMessage("Select a bulking center");
      }
      app.step++;
    },

    //
    // Save Delivery/Request
    saveDeliveryRequest() {
      let app = this;

      app.isLoading = true;
      const formData = new FormData();
      formData.append("quantity", app.quantity);
      formData.append("quantity_type", app.quantityType);
      if (
        (app.quantity == 0 || app.quantityType == "") &&
        (app.farmRequests[0].requestQuantity === "" ||
          app.farmRequests[0].requestType === "")
      ) {
        app.showErrorMessage(
          "Your Develivery request is Neither Feed Nor Eggs! Please Look again!"
        );
      }
      if (
        app.farmRequests[0].requestQuantity === "" ||
        app.farmRequests[0].requestType === ""
      ) {
        formData.append("farmRequests", JSON.stringify([]));
      } else {
        formData.append("farmRequests", JSON.stringify(app.farmRequests));
      }
      formData.append("delivery_date", app.deliveryDate);
      formData.append("delivery_start_time", app.deliveryStartTime);
      formData.append("delivery_end_time", app.deliveryEndTime);
      formData.append("bulking_center", app.bulkingCenter);

      // Request.postMethod("/api/farmer/saveDeliveryRequest", formData)
      //     .then((result) => {
      //         console.log(result.data);
      //         if (result.response === "success") {
      //             return app.showSuccessMessage(
      //                 "Request submitted successfully"
      //             );
      //         }
      //         app.isLoading = false;
      //     })
      //     .catch((error) => {
      //         console.log(error.response);
      //         app.isLoading = false;
      //     });
      console.log(formData);

      $.ajax({
        processData: false,
        contentType: false,
        enctype: "multipart/form-data",
        type: "post",
        url: `/api/farmer/saveDeliveryRequest`,
        headers: {
          Authorization: `Bearer ${authToken()}`,
        },
        data: formData,
        success(data) {
          console.log("");
          console.log("");
          console.log("");
          console.log(data);
          $("#requestDeliveryModal").modal("toggle");
          if (data.response === "success") {
            app.showSuccessMessage("Request submitted successfully");
            app.getStatistics();
          }

          app.step = 1;
          app.quantity = "";
          app.quantityType = "";
          app.farmRequests = [
            {
              id: 1,
              requestQuantity: "",
              requestType: "",
              requestTypeText: "",
            },
          ];
          app.deliveryDate = "";
          app.deliveryStartTime = "";
          app.deliveryEndTime = "";
          app.bulkingCenter = "";
          app.isLoading = false;
        },
        error(e) {
          console.log(e);
          app.isLoading = false;
        },
      });
    },

    //
    // Get statistics
    getStatistics() {
      let app = this;
      Request.getMethod("/api/farmer/statistics")
        .then((result) => {
          console.log(result.data.statistics);
          if (result.data.response === "success") {
            app.statistics = result.data.statistics;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getDeliveries() {
      let app = this;
      Request.getMethod("/api/farmer/deliveries")
        .then((result) => {
          console.log(result.data.statistics);
          if (result.data.response === "success") {
            app.farmerdeliveries = result.data.farmerdeliveries;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getFarmerPayments() {
      let app = this;
      Request.getMethod("/api/farmer/payments")
        .then((result) => {
          console.log(result.data.statistics);
          if (result.data.response === "success") {
            app.payments = result.data.payments;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    //
    // Get farm inputs
    getInputs() {
      let app = this;
      Request.getMethod("/api/farmer/inputs")
        .then((result) => {
          console.log(result.data);
          if (result.data.response === "success") {
            app.inputs = result.data.inputs;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    //
    // Get bulking centers
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

    //
    //
    createGauge() {
      // Create a new Gauge
      const app = this;
      let cpuGauge = Gauge(document.getElementById("cpuSpeed"), {
        max: 10,
        dialStartAngle: -90,
        dialEndAngle: -90.001,
        value: app.value / 10,
        label: function () {
          return "";
        },
        color: function (value) {
          if (value > 5) {
            return "#5ee432"; // green
          } else if (value < 4 && value > 3.5) {
            return "#fffa50"; // yellow
          } else if (value < 3 && value > 2.5) {
            return "#f7aa38"; // orange
          } else {
            return "#ef4655"; // red
          }
        },
      });
    },
  },
};
</script>

<style scoped></style>
