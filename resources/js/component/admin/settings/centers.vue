<template>
  <div class="d-flex" v-cloak>
    <side-navigation />
    <!-- Page Content -->
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
                  <a href="#"
                    style="color: #333; padding: 0.5rem 2.5rem !important"
                    class="nav-item nav-link"
                    >Bulking Centers</a>
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
          <div class="cp-card w-100 mx-4 h-100 bg-white" style="margin-top: -9px;margin-left: 15px;">
            <div class="card-body" style="min-height: 70vh">
              <div
                    style="padding-left: 1rem; padding-right: 1rem"
                                   >
                  <div
                      style="
                        display: flex;
                        margin-top: -5px;
                        margin-bottom: 10px;
                      "
                    >
              <button
                  class="px-4 font-weight-normal text-white btn-sm bg-primary"
                  data-toggle="modal"
                  data-target="#centersmodal"
                  style="
                        width: 180px;
                        height: 35px;
                        margin-top: 1rem;
                        margin-bottom: 0.5rem;
                        font-size: 15px;
                        margin-left: auto;"
                >
                  Add Bulking Center
                </button>
            </div>
            <!-- Modal -->
            <div
              class="modal fade"
              id="centersmodal"
              tabindex="-1"
              aria-labelledby="centersmodalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog mx-auto">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title mx-auto" id="centersmodalLabel">
                      Add New Center
                    </h4>
                  </div>
                  <!-- centers form -->
                  <div class="modal-body">
                    <form id="center-form" class="mt-4">
            <!--
              <input hidden v-if="category.id" name="id" :value="category.id" />

              -->
            <div class="form-group">
              <label> Name </label>
              <input
                class="form-control py-3 px-3 cp-text-l"
                name="name"
                placeholder="Name"
                type="text"
                v-model="name"
                required
              />

              <input hidden name="id" :value="id" />
            </div>
            <div class="form-group">
              <label> Address </label>
              <input
                class="form-control py-3 px-3 cp-text-l"
                name="address"
                placeholder="address"
                type="address"
                v-model="address"
                required
              />
            </div>
            <div class="form-group">
              <label> collection Agent </label>
            </div>
            <select class="form-select form-control" 
            v-model="collectionagent" aria-label="agentscollect">
          <option disabled value="">Select </option>
          <option 
          v-for="(x, index) in details" :key="index"
          :value="x.user.name">{{x.user.name}}</option>
          
</select>
          </form>
          <div class="w-100 d-flex justify-content-center text-center mt-4">
            <button
              type="button"
              class="cp-btn cp-btn-g-primary px-6"
              @click.prevent="addcenter"
            >
              <span>
                <i v-if="isLoading" class="fa fa-spinner fa-spin"> </i>

                SAVE CENTER
              </span>
            </button>                  </div>
                </div>
              </div>
            </div>
          </div>

          <center-management />
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
import SideNavigation from "../.././Layout/adminLayout/sideNavigation.vue";
import menuList from "../.././Layout/adminLayout/menuList.vue";
import centerManagement from "../../admin/settings/centerManagement.vue";
// import header from "../.././Layout/adminLayout/header.vue";
import Request from "../../mixins/requestHelper";
import AdminHeader from "../../Layout/adminLayout/header.vue";
// import { useCenters } from "../../mixins/fetchsettings";
// import { onMounted } from "vue";
import Swal from "sweetalert2";
import { title } from "process";

export default {
  name: "centers",
  components: { SideNavigation, menuList, centerManagement, AdminHeader },
  mounted() {
    const app = this;
    //app.user=Request.getUser();
    app.getUsers();
    app.getCenter();
  },

  data: function () {
    return {
      // center: {
        // id: "",
        name: "",
        address: "",
        collectionagent: "",
        isLoading: false,
        details: {},



      // },
    };
  },
  methods: {
    addcenter() {
      const app = this;
      let form = $("#center-form");
      if (form.valid()) {
        app.isLoading = true;

        const formData = {
          address: app.address,
          name: app.name,
          collectionagent: app.collectionagent,
        };                   
        Request.postMethod("/api/store", formData)
          .then((response) => {
            app.isLoading = false;
            Swal.fire({
                                title: 'Bulking Center Saved!',
                                icon: 'success',
                                timer: 2000
                            })

          $("#centersmodal").modal("hide");
          window.location.reload();
          // console.log(response);
          })
          .catch((error) => {
            app.isLoading = false;
            //console.log(error.response);
            if (error.response.status == 405) {
              app.showErrorMessage(error.response.data);
              return;
            }

            app.showErrorMessage("Somehting Went Wrong, try again latter");
          });
      }
    },
    getCenter() {
      //Consider re using the helper  function for making api  calls

      Request.getMethod("/api/admin/centers")
        .then((response) => {
          this.centers = response.data;
        })
        .catch((error) => {
          console.log(error.response);
        });

      /*

      axios
        .get("api/centers")
        .then((response) => {
          this.centers = response.data;

          console.log(this.center);
        })
        .catch((error) => {
          console.log(error.response);
        });
        */
    },
  

    getUsers() {
      const app = this;
      Request.getMethod("/api/admin/get-collectors")
        .then((response) => {
          //console.log(response);
          //app.content = response.data.admin;
          app.details = response.data;

          //set the required records for the specific users

          //console.log(app.content);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
};
</script>
<style scope>
.btn {
  background-color: #a3360b;
}
</style>