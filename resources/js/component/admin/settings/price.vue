<template>
<div class="d-flex" v-cloak>
    <side-navigation />
    <div id="page-content-wrapper">
      <admin-header />
     
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
                  <div class="cp-card w-100 mx-4 h-100 bg-white" style="margin-top: -9px;">
              <div class="card-body" style="min-height: 70vh">
                <!--Super admin management-->
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
                  style="
                        width: 180px;
                        height: 35px;
                        margin-top: 1rem;
                        margin-bottom: 0.5rem;
                        font-size: 15px;
                        margin-left: auto;"
      data-toggle="modal" data-target="#pricemodal">
        Add New Price
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
      <div class="modal-body">
        <h4>Add New Price</h4>
   
      <!-- centers form -->
      <div class="modal-body">
          <form id="price" action="POST">
      <div class="form-group">
            <label for="pricelabel" class="col-form-label">Price</label>
            <div class="input-group mb-2">
                <input type="text" name="newprice" class="form-control" 
                v-model="newprice" />    

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
        <th>PRICE/KG (UGX)</th>
        <th style="">CREATED</th>

        <th style="margin-left: auto"></th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="(price, index) in prices" :key="index">
        <td>{{ price.newprice }}</td>
        <td>{{ price.priceCreated.substring(0,10)   }}</td>
        <td style="margin-left: auto">
          
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
</div>
</template>

<script>
import SideNavigation from "../../Layout/adminLayout/sideNavigation.vue";
import Request from "../../mixins/requestHelper";
import priceManagement from "../../admin/settings/priceManagement.vue";
import AdminHeader from "../../Layout/adminLayout/header.vue";


export default{
    name:"prices",
    components: { SideNavigation, priceManagement, AdminHeader },
    mounted(){
        let app = this;
        app.getLatestPrice();
         
    },
    data(){
        return{ 
            prices: [],
           
        }
    },
    methods: {
        store(){
            let app = this;
            let form = $("#price");
            if (form) {
                let formData = new FormData();
                formData.append('newprice', app.newprice);

                $.ajax({
                        url: `/api/save-price`,
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
                            app.getLatestPrice();
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
                      Vue.nextTick(function () {
                        axios.delete(`/api/delete-price/${id}`)
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
                      })
                  } 
                })

                            this.getLatestPrice();

  },
    getLatestPrice() {
            let app = this;
            Request.getMethod("/api/price-list")
                .then((result) => {
                 console.log(result.data);
                 app.prices = result.data;
                   
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