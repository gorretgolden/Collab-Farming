<template>
    <div class="d-flex" v-cloak>
      <side-navigation />
      <!-- Page Content -->
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
        <router-link to="/feed-requests" class="nav-link">
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


        <!-- table goes here -->
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>FARMER</th>
                    <th>COLLECTION CENTER/SCHEDULE</th>
                    <th>QUOTED DELIVERY</th>
                    <th>WEIGHT (1)</th>
                    <th>WEIGHT (2)</th>
                    
                </tr>
            </thead>
            <tbody>
              <tr v-for="egg in eggRequests" :key="egg.id">

                    <th v-if="egg.weights.length != 0 & egg.secondweights.length == 0" 
                    class="text-primary"
                      style="cursor: pointer"
                      @click="toggleSecondWeight(egg)"
                      >
                      {{ egg?.farmer?.name }}
                    </th>
                    <th v-else-if="egg.secondweights.length != 0"
                    class="text-primary"
                      style="cursor: pointer"
                      >
                      {{ egg?.farmer?.name }}
                    </th>
                    <th v-else
                    class="text-primary"
                      style="cursor: pointer"
                      @click="toggleApprove(egg)"
                      >
                      {{ egg?.farmer?.name }}
                    </th>
                        <td>
                          {{ egg?.center?.name }} on
                       {{egg.delivery_date}} between
                      {{ egg.delivery_start_time }} and
                      {{ egg.delivery_end_time }} 
                        </td>

                    <td>
                      {{ egg.quantity }} {{ egg.quantity_type }}
                    </td>
                    <td v-for="x in egg.weights" v-bind:key="x">
                        <div v-if="x.weight1">{{x.weight1}} KGs</div>
                        
                    </td>
                    <td v-for="y in egg.secondweights" v-bind:key="y">
                        <div v-if="y.weight2">{{y.weight2}} KGs</div>
                        
                    </td>
                   
                  
                </tr>
            </tbody>
            
        </table>
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
                                <h4 v-if="step === 1" class="text-center">
                                    Weigh the Delivery
                                </h4>
                               <p class="text-center">by {{ clickedReq?.farmer?.name }} </p> 
                               <hr>
                               <form v-if="step === 1" id="price-form">
                               <div class="row">
                                <div class="col-md-4">
                                  <h6>Quantity Expected</h6>
                                  <h2>{{ clickedReq?.quantity }} trays</h2>
                                </div>
                                <div class="col-md-4">
                                  <h6>Actual Number of Trays</h6>
                                  <input type="text" v-model="trays" placeholder="0" class="form-control"/>
                                </div>
                                <div class="col-md-4">
                                  <h6>Average Weight (in KGs/Trays)</h6>
                                  <input type="text" v-model="weight" placeholder="0" class="form-control"/>

                                </div>

                               </div>
                               <hr>
                               <div class="row">
                                <div class="col-md-4">
                                  <h6>Weighing #</h6>
                                  <h2>1</h2>
                                
                                </div>
                                <div class="col-md-8">
                                  <h6>Bulking Center</h6>
                                  <select name="bulking_center" id="bulking_center" class="form-control" v-model="bulking_center">
                                    <option value="">Select</option>
                                            <option
                                                v-for="c in bulkingCenterList"
                                                :key="c.id"
                                                :value="c.id"
                                            >
                                                {{ c?.name }}
                                            </option>
                                  </select>
                                </div>
                                <div class="row" style="background-color:#D3D3D3;margin-bottom: 5%;margin-top: 5%;">
                                  <div class="col-md-5">
                                    <h2>{{ result}}</h2>
                                    <h6>UGX</h6>

                                  </div>
                                  <div class="col-md-3" style="text-align:right">
                                    <p> <span style="font-size:x-large">{{latestPrice["newprice"]}} </span>UGX</p>
                                    <h6>Current Price/KG</h6>
                                  </div>
                                  <div class="col-md-3" style="text-align:left">
                                    <div style="color:white">
                                        <button
                                        @click.prevent="proceed"
                                            type="submit"
                                            class="btn btn-primary"
                                            style="width:200px;height:60px;margin-top:10px;background-image: linear-gradient( #c86704, #e47c0c, #cc7c2a);"
                                        >
                                            <span
                                                ><i
                                                    v-if="isLoading"
                                                    class="fa fa-spinner fa-spin"
                                                ></i></span
                                            >SAVE
                                        </button>
                                    </div>
                                  </div>

                                </div>
                               </div>
                                    
                                  </form>
                                
                                  <form v-else id="price-form">
                                <h4 class="text-center">
                                    Confirm the Weight
                                </h4>
                               <div class="row">
                                <div class="col-md-4">
                                  <h6>Quantity Expected</h6>
                                  <h2>{{ clickedReq?.quantity }} trays</h2>
                                </div>
                                <div class="col-md-4">
                                  <h6>Actual Number of Trays</h6>
                                  <input type="text" v-model="trays" placeholder="0" class="form-control" disabled/>
                                </div>
                                <div class="col-md-4">
                                  <h6>Average Weight (in KGs/Trays)</h6>
                                  <input type="text" v-model="weight" placeholder="0" class="form-control" disabled/>

                                </div>

                               </div>
                               <hr>
                               <div class="row">
                                <div class="col-md-4">
                                  <h6>Weighing #</h6>
                                  <h2>1</h2>
                                
                                </div>
                                <div class="col-md-8">
                                  <h6>Bulking Center</h6>
                                  <select name="bulking_center" id="bulking_center" class="form-control" v-model="bulking_center" disabled>
                                    <option value="">Select</option>
                                            <option
                                                v-for="c in bulkingCenterList"
                                                :key="c.id"
                                                :value="c.id"
                                            >
                                                {{ c?.name }}
                                            </option>
                                  </select>
                                </div>
                                <div class="row" style="background-color:#D3D3D3;margin-bottom: 5%;margin-top: 5%;">
                                  <div class="col-md-3">
                                    <h2>{{ result}}</h2>
                                    <h6>UGX</h6>

                                  </div>
                                  <div class="col-md-3" style="text-align:right">
                                    <p> <span style="font-size:x-large">{{latestPrice["newprice"]}} </span>UGX</p>
                                    <h6>Current Price/KG</h6>
                                  </div>
                                  <div class="col-md-6" style="text-align:left">
                                    <div style="color:white">
                                      <button
                                      @click.prevent="goBack"
                                            type="submit"
                                            class="btn btn-primary"
                                            style="width:150px;height:60px;margin-top:10px;background-color: #808080;margin-right: 10px;"
                                            :disabled="isLoading"

                                        >
                                            <span
                                                ><i
                                                    v-if="isLoading"
                                                    class="fa fa-spinner fa-spin"
                                                ></i></span
                                            >BACK
                                        </button>
                                        <button
                                            @click.prevent="addTotalPrice(clickedReq?.id)"
                                            type="submit"
                                            class="btn btn-primary"
                                            style="width:150px;height:60px;margin-top:10px;background-image: linear-gradient( #c86704, #e47c0c, #cc7c2a);"
                                        >
                                            <span
                                                ><i
                                                    v-if="isLoading"
                                                    class="fa fa-spinner fa-spin"
                                                ></i></span
                                            >SAVE
                                        </button>
                                    </div>
                                  </div>

                                </div>
                               </div>
                                    
                                  </form>
                            </div>
              </div>
          </div>
      </div>
      <div
          class="modal fade"
          id="eggDeliveryModal2"
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
                                <h4 v-if="step === 1" class="text-center">
                                    Weigh the Delivery
                                </h4>
                               <p class="text-center">by {{ clickedReq?.farmer?.name }} </p> 
                               <hr>
                               <form v-if="step === 1" id="price-form-2">
                               <div class="row">
                                <div class="col-md-4">
                                  <h6>Quantity Expected</h6>
                                  <h2>{{ clickedReq?.quantity }} trays</h2>
                                </div>
                                <div class="col-md-4">
                                  <h6>Actual Number of Trays</h6>
                                  <input type="text" v-model="trays" placeholder="0" class="form-control"/>
                                </div>
                                <div class="col-md-4">
                                  <h6>Average Weight (in KGs/Trays)</h6>
                                  <input type="text" v-model="weight" placeholder="0" class="form-control"/>

                                </div>

                               </div>
                               <hr>
                               <div class="row">
                                <div class="col-md-4">
                                  <h6>Weighing #</h6>
                                  <h2>2</h2>
                                
                                </div>
                                <div class="col-md-8">
                                  <h6>Bulking Center</h6>
                                  <select name="bulking_center" id="bulking_center" class="form-control" v-model="bulking_center">
                                    <option value="">Select</option>
                                            <option
                                                v-for="c in bulkingCenterList"
                                                :key="c.id"
                                                :value="c.id"
                                            >
                                                {{ c?.name }}
                                            </option>
                                  </select>
                                </div>
                                <div class="row" style="background-color:#D3D3D3;margin-bottom: 5%;margin-top: 5%;">
                                  <div class="col-md-5">
                                    <h2>{{ result}}</h2>
                                    <h6>UGX</h6>

                                  </div>
                                  <div class="col-md-3" style="text-align:right">
                                    <p> <span style="font-size:x-large">{{latestPrice["newprice"]}} </span>UGX</p>
                                    <h6>Current Price/KG</h6>
                                  </div>
                                  <div class="col-md-3" style="text-align:left">
                                    <div style="color:white">
                                        <button
                                        @click.prevent="proceed"
                                            type="submit"
                                            class="btn btn-primary"
                                            style="width:200px;height:60px;margin-top:10px;background-image: linear-gradient( #c86704, #e47c0c, #cc7c2a);"
                                        >
                                            <span
                                                ><i
                                                    v-if="isLoading"
                                                    class="fa fa-spinner fa-spin"
                                                ></i></span
                                            >SAVE
                                        </button>
                                    </div>
                                  </div>

                                </div>
                               </div>
                                    
                                  </form>
                                
                                  <form v-else id="price-form-2">
                                <h4 class="text-center">
                                    Confirm the Weight
                                </h4>
                               <div class="row">
                                <div class="col-md-4">
                                  <h6>Quantity Expected</h6>
                                  <h2>{{ clickedReq?.quantity }} trays</h2>
                                </div>
                                <div class="col-md-4">
                                  <h6>Actual Number of Trays</h6>
                                  <input type="text" v-model="trays" placeholder="0" class="form-control" disabled/>
                                </div>
                                <div class="col-md-4">
                                  <h6>Average Weight (in KGs/Trays)</h6>
                                  <input type="text" v-model="weight" placeholder="0" class="form-control" disabled/>

                                </div>

                               </div>
                               <hr>
                               <div class="row">
                                <div class="col-md-4">
                                  <h6>Weighing #</h6>
                                  <h2>2</h2>
                                
                                </div>
                                <div class="col-md-8">
                                  <h6>Bulking Center</h6>
                                  <select name="bulking_center" id="bulking_center" class="form-control" v-model="bulking_center" disabled>
                                    <option value="">Select</option>
                                            <option
                                                v-for="c in bulkingCenterList"
                                                :key="c.id"
                                                :value="c.id"
                                            >
                                                {{ c?.name }}
                                            </option>
                                  </select>
                                </div>
                                <div class="row" style="background-color:#D3D3D3;margin-bottom: 5%;margin-top: 5%;">
                                  <div class="col-md-3">
                                    <h2>{{ result}}</h2>
                                    <h6>UGX</h6>

                                  </div>
                                  <div class="col-md-3" style="text-align:right">
                                    <p> <span style="font-size:x-large">{{latestPrice["newprice"]}} </span>UGX</p>
                                    <h6>Current Price/KG</h6>
                                  </div>
                                  <div class="col-md-6" style="text-align:left">
                                    <div style="color:white">
                                      <button
                                      @click.prevent="goBack"
                                            type="submit"
                                            class="btn btn-primary"
                                            style="width:150px;height:60px;margin-top:10px;background-color: #808080;margin-right: 10px;"
                                            :disabled="isLoading"

                                        >
                                            <span
                                                ><i
                                                    v-if="isLoading"
                                                    class="fa fa-spinner fa-spin"
                                                ></i></span
                                            >BACK
                                        </button>
                                        <button
                                            @click.prevent="addSecond(clickedReq?.id)"
                                            type="submit"
                                            class="btn btn-primary"
                                            style="width:150px;height:60px;margin-top:10px;background-image: linear-gradient( #c86704, #e47c0c, #cc7c2a);"
                                        >
                                            <span
                                                ><i
                                                    v-if="isLoading"
                                                    class="fa fa-spinner fa-spin"
                                                ></i></span
                                            >SAVE
                                        </button>
                                    </div>
                                  </div>

                                </div>
                               </div>
                                    
                                  </form>
                            </div>
              </div>
          </div>
      </div>
    </div>
    <!-- add modal with in another modal for  editing weights
    and confirming weights-->
</div>

</div>


            </div>

        <!-- end  -->
        </div>
  
  </template>
  
  <script>
  import SideNavigation from ".././Layout/agentLayout/sideNavigation.vue";
  import menuList from ".././Layout/agentLayout/menuList.vue";
  import Request from ".././mixins/requestHelper";
//   import AdminHeader from ".././Layout/adminLayout/header.vue";
  
  export default {
    name: "egg-weights",
    data() {
    return {
      user: {},
      isLoading: false,
      bulkingCenterList: [],
      latestPrice: {},
      eggRequests: [],
      clickedReq: {},
      trays: 0,
      weight: 0,
      step: 1,
      bulking_center: {},


    };
  },
  computed:{
    result(){
      return parseInt(this.trays) * parseFloat(this.weight) *parseInt(this.latestPrice["newprice"])
    },
    weight1(){
      return parseInt(this.trays) * parseFloat(this.weight)
    },

  },
    components: { SideNavigation, menuList },
    
    mounted() {
    const app = this;
    app.user = Request.getUser();
    app.getEggRequests();
    app.getBulkingCenters();
    app.getLatestPrice();

    // app.getUser();
    // alert("Ok")
  },
  methods: {
    getUser() {
      //alert("Ok")
    },
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
        goBack() {
            this.step--;
        },
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
      addWeight(id){

      },
      proceed(){
        let app = this;
        if (app.trays <= 0 || app.trays == null) {
          Swal.fire({
              title: 'Invalid data',
              html: " <small>Fill in actual number of trays</small>",
              icon: 'warning',
              showCancelButton: true,
              timer: 4000
            })
                return 
            }
            if (app.weight <= 0 || app.weight == null) {
              Swal.fire({
              title: 'Invalid data',
              html: " <small>Fill in the weight</small>",
              icon: 'warning',
              showCancelButton: true,
              timer: 4000
            })
                return 
            }
           
            app.step++;
      },
      toggleApprove(egg) {
          console.log(egg);
          this.clickedReq = egg;
          $("#eggDeliveryModal").modal("toggle");
      },
      toggleSecondWeight(egg) {
          console.log(egg);
          this.clickedReq = egg;
          $("#eggDeliveryModal2").modal("toggle");
      },
      addTotalPrice(egg) {
      let app = this;
      let form = $("#price-form");
      if (form) {
        app.isLoading = true;

        let formData = new FormData();
        formData.append('trays', app.trays);
        formData.append('weight', app.weight);
        formData.append('result', app.result);
        formData.append('weight1', app.weight1);
        formData.append('latestprice', app.latestPrice["newprice"]);
        formData.append('bulking_center', app.bulking_center);


        $.ajax({
          url: `/api/save_total/${egg}`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success(data) {
             Swal.fire({
              title: "Saved",
              icon: "success",
              html: '<p style="font-size: 14px">The record has successfully been saved.</p>',
              showCloseButton: false,
              showCancelButton: false,
              focusConfirm: true,
              confirmButtonText: "OK",
              confirmButtonColor: "#43ad60",
              allowOutsideClick: false,
              allowEscapeKey: false,
              closeOnClickOutside: false,
              
            })
            app.isLoading = false;

            $("#eggDeliveryModal").modal("hide");

          app.getEggRequests();

          },
        });      
      }
    }, 
    addSecond(egg) {
      let app = this;
      let form = $("#price-form-2");
      if (form) {
        app.isLoading = true;

        
        let formData = new FormData();
        formData.append('trays', app.trays);
        formData.append('weight', app.weight);
        formData.append('result', app.result);
        formData.append('weight1', app.weight1);
        formData.append('latestprice', app.latestPrice["newprice"]);
        formData.append('bulking_center', app.bulking_center);
        formData.append('latestprice', app.latestPrice["newprice"]);




        $.ajax({
          url: `/api/second_weight/${egg}`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success(data) {
             Swal.fire({
              title: "Saved",
              icon: "success",
              html: '<p style="font-size: 14px">The record has successfully been saved.</p>',
              showCloseButton: false,
              showCancelButton: false,
              focusConfirm: true,
              confirmButtonText: "OK",
              confirmButtonColor: "#43ad60",
              allowOutsideClick: false,
              allowEscapeKey: false,
              closeOnClickOutside: false,
              
            })
            app.isLoading = false;

            $("#eggDeliveryModal2").modal("hide");

          app.getEggRequests();

          },
        });      
      }
    }, 


    openOrCloseMenu() {
      $("#cp-nav-menu-enum").toggle();
    },
    
  },
  };
  </script>
  <style scope>
    a.active{
      border-bottom: 3px solid;
      color:slategrey;
   }
     h5{
        color:slategrey;
     }
  </style>