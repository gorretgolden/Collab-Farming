<template>
  <div class="d-flex" v-cloak>
  <side-navigation />
  <div id="page-content-wrapper">
      <admin-header />
      <!-- centers, prices, inputs -->

      <div class="content-padding">
        <div class="row">
          <div class="col-md-12">
            <div class="row mb-1">
              <div class="col-md-12" style="">
                <div class="col-md-12">
                  <nav
                  class="nav nav-tab"
                  style="height: 55px; margin-bottom: -1rem"
                  id="unicef-tabs-cit"
                >
                <router-link to="/centers">
                  <li
                    style="color: #333; padding: 0.5rem 2.5rem !important"
                    class="nav-item nav-link"
                    >Bulking Centers</li
                  >
                  </router-link>
                  <router-link to="/newprices">
                  <a
                    href="#"
                    style="color: #333; padding: 0.5rem 2.5rem !important"
                    class="nav-item nav-link"
                    >Egg Prices</a>
                    </router-link>
                    <router-link to="/farmer-inputs">
                    <a
                    href="#"
                    style="color: #333; padding: 0.5rem 2.5rem !important"
                    class="nav-item nav-link"
                    >Inputs</a>
                    </router-link>
                  </nav>
                  </div>
                          </div>
                  <!-- bulking center button -->
                  <div class="cp-card w-100 mx-4 h-100 bg-white" style="margin-top: -9px;">
                    <div class="card-body" style="min-height: 70vh">
                      <div
                            style="padding-left: 1rem; padding-right: 1rem"
                                          >
                          <div
                              style="
                                display: flex;
                                margin-top: -10px;
                                margin-bottom: 10px;
                              "
                    >
                    <button 
                    class="px-4 font-weight-normal text-white btn-sm bg-primary"
                    data-toggle="modal" 
                    data-target="#pricemodal"
                    style="
                        width: 180px;
                        height: 35px;
                        margin-top: 1rem;
                        margin-bottom: 0.5rem;
                        font-size: 15px;
                        margin-left: auto;"
                      >
                        Add New Input
                    </button>
                    </div>
            <!-- Modal -->
          <div class="modal fade" id="pricemodal" tabindex="-1" 
          aria-labelledby="pricemodalLabel" aria-hidden="true">
          <div
                      class="modal-dialog modal-dialog-centered modal-lg"
                      role="document"
                  >
                  <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title mx-auto" id="inputsmodalLabel">Add New Input</h4>
            
                </div>
                <!-- centers form -->
                <div class="modal-body">
                    <form id="input-form">
                <div class="form-group">
                      <label for="inputs" class="col-form-label">Input</label>
                      <div class="input-group mb-2">
                          <input type="text" class="form-control" v-model="inputs" />    
                      </div>
     

                </div>
                </form>
                      </div>
                      <div class="modal-footer">
                        <button class="btn  font-weight-normal px-5 text-white mx-auto"
                        @click.prevent="store()" data-dismiss="modal">SAVE</button>
                      </div>
                </div>  
                  </div>
                  
                </div>

          </div>
          <table class="table table-sm unicef-activities-table">
    <thead>
      <tr>
        <th>AVAILABLE INPUTS</th>
        <th style="">CREATED</th>

        <th style="margin-left: auto"></th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="(farmerinput, index) in farmerinputs" :key="index">
        <td>{{ farmerinput.inputs}}</td>
        <td> {{ farmerinput.inputCreated.substring(0,10)}}</td>
        <td style="margin-left: auto">
          <span class="mx-3 h5 text-black-50">
            <button type="button"
            @click.prevent="showupdateInput(farmerinput)"
            ><i class="fas fa-pencil-alt">
            </i></button>
            <div class="modal fade" id="editInputmodal" tabindex="-1" 
          aria-labelledby="editInputmodalLabel" aria-hidden="true">
          <div
                      class="modal-dialog modal-dialog-centered modal-lg"
                      role="document"
                  >
                  <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title mx-auto" id="inputsmodalLabel">Edit Input</h4>
            
                </div>
                <!-- centers form -->
                <div class="modal-body">
                    <form id="edit-input-form">
                <div class="form-group">
                      <label for="inputs" class="col-form-label">Input </label>
                      <div class="input-group mb-2">
                          <input type="text" class="form-control" :placeholder="selectedInput.inputs" v-model="edit_inputs" />    
                      </div>
     

                </div>
                </form>
                      </div>
                      <div class="modal-footer">
                        <button class="btn  font-weight-normal px-5 text-white mx-auto"
                        type="submit"
                        @click.prevent="updateInput(selectedInput.id)" data-dismiss="modal">SAVE</button>
                      </div>
                </div>  
                  </div>
                  
                </div>
            </span>
            <span class="mx-3 h5 text-black-50">
            <button 
            type="button" @click.prevent="deleteInput(farmerinput.id)"
            > <i class="fas fa-trash-alt"></i>
            </button>

              </span>
        </td>
      </tr>
    </tbody>
  </table>
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
import SideNavigation from "../../Layout/adminLayout/sideNavigation.vue";
import Request from "../../mixins/requestHelper";
import priceManagement from "../../admin/settings/priceManagement.vue";
import AdminHeader from "../../Layout/adminLayout/header.vue";

export default{
  name:"inputs",
  components: { SideNavigation, priceManagement, AdminHeader },
  mounted(){
      const app = this;
      app.getLatestPrice();
       
  },
  data(){
      return{ 
          farmerinputs: [],
          selectedInput: {},
          isLoading: false,

         
      }
  },
  methods: {
    showupdateInput(item){
      let app = this;
      app.selectedInput  = item;
      $("#editInputmodal").modal("show");
    },
    updateInput(id) {
      let app = this;
      let form = $("#edit-input-form");
      if (form) {
        let formData = new FormData();
        formData.append('inputs', app.edit_inputs); 
        formData.append('id', this.selectedInput.id);
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
    store(){
            let app = this;
            let form = $("#input-form");
            if (form) {
                let formData = new FormData();
                formData.append('inputs', app.inputs);

                $.ajax({
                        url: `/api/store-input`,
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success() {
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
                            app.getInputsList();

                            $("#pricemodal").modal("hide");




                        },
            });  

        }
       
        
    
     
      
  },
  deleteInput(id){

  
    const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-2'
                  },
                  buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                  title: 'Confirm Deletion',
                  html: " <small>You are about to delete this input. Proceed ?</small>",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, Proceed!',
                  cancelButtonText: 'No, cancel!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.isConfirmed) {

                    axios.delete(`/api/delete-input/${id}`)
                    this.getInputsList();

                    Swal.fire({
                            title: "Deleted",
                            icon: "success",
                            html: '<p style="font-size: 14px">The record has successfully been deleted.</p>',
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
                  })
                            

  },
  getInputsList() {
            let app = this;
            Request.getMethod("/api/input-list")
                .then((result) => {
                 console.log(result.data);
                 app.farmerinputs = result.data;
           
                })
                .catch((error) => {
                    console.log(error);
                });
        },
  getLatestPrice() {
          let app = this;
          Request.getMethod("/api/input-list")
              .then((result) => {
               console.log(result.data);
               app.farmerinputs = result.data;
                 
                  // if (result.data.response === "success") {
                  //     app.latestPrice = result.data.latestPrice;
                  // }
              })
              .catch((error) => {
                  console.log(error);
              });
      },
},
};


</script>