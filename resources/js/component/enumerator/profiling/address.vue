<template>
  <form
    id="collect-data"
    @submit.prevent=""
    class="needs-validation"
    novalidate
  >
    <div class="cp-card" style="margin: 1rem 0rem 0 2rem; padding: 1rem">
      <div id="step0-view" class="content">
        <div class="">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <p class="h2" style="font-weight: 380">Egg Producer Bio Data</p>
                <hr />

                <div class="form-group">
                  <label for="names">Names</label>
                  <input
                    type="text"
                    class="form-control col-6"
                    v-model="names"
                    id="names"
                    aria-describedby="UserName"
                    placeholder="Names"
                    required
                  />
                </div>

                <div class="form-group">
                  <label for="email">Email Address</label>
                  <input
                    type="email"
                    v-model="email"
                    class="form-control col-6"
                    id="email"
                    aria-describedby="UserName"
                    placeholder="Email Address"
                    required
                  />
                </div>

                <div class="form-group">
                  <label for="date">Data Collection Date</label>
                  <input
                    type="date"
                    class="form-control col-6"
                    v-model="collection_date"
                    id="date"
                    aria-describedby="Date"
                    placeholder="date"
                    required
                  />
                </div>

                <p class="h2" style="font-weight: 380; margin-top: 2rem">
                  Geographic Information Address
                </p>
                <hr />

                <div class="form-group">
                  <label for="address">1. Address</label>

                  <div style="width: 50%; margin-bottom: -1rem">
                    <map-view
                      inputId="address"
                      :onSetEvent="(val) => onSetEvent(val)"
                      :required="true"
                      :value="address"
                  
                    />
                  </div>
                </div>

                <div class="form-group">
                  <label for="District">2.District</label>
                  <select
                    v-model="district"
                    @change="(e) => getSubCounty(e)"
                    class="form-control col-6"
                    id="District"
                    required
                  >
                    <option value="">Select</option>
                    <option
                      v-for="(c, index) in districts"
                      :key="index + 'static_districts'"
                      :value="c.DistrictName"
                    >
                      {{ c.DistrictName }}
                    </option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="Subcounty">3.Sub County</label>
                  <select
                    v-model="sub_county"
                    @change="(e) => getParish(e)"
                    class="form-control col-6"
                    id="Subcounty"
                    required
                  >
                    <option value="">Select</option>
                    <option
                      :value="c.SubCountyName"
                      v-for="(c, index) in subCountyData"
                      :key="index + 'sub_county'"
                    >
                      {{ c.SubCountyName }}
                    </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="Parish">4. Parish</label>
                  <select
                    required
                    v-model="parish"
                    class="form-control col-6"
                    @change="(e) => getVillage(e)"
                    id="Parish"
                  >
                    <option value="">Select</option>
                    <option
                      :value="c.ParishName"
                      v-for="(c, index) in parishes"
                      :key="index + 'parish'"
                    >
                      {{ c.ParishName }}
                    </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="Village">5. Village</label>
                  <select
                    v-model="village"
                    class="form-control col-6"
                    id="Village"
                    required
                  >
                    <option value="">Select</option>
                    <option
                      :value="c.VillageName"
                      v-for="(c, index) in villages"
                      :key="index + 'village'"
                    >
                      {{ c.VillageName }}
                    </option>
                  </select>
                </div>

                <div
                  class="text-center mx-auto"
                  style="display: flex; justify-content: center; padding: 2rem"
                >
                  <button
                    :disabled="isLoading"
                    class="submit_event cp-btn"
                    style="padding: 1rem 5rem; background-color: #004e89"
                  >
                    <span
                      ><i v-if="isLoadingExit" class="fa fa-spinner fa-spin"></i
                    ></span>
                    SAVE & EXIT
                  </button>

                  <button
                    :disabled="isLoading"
                    class="cp-btn cp-btn-g-primary"
                    style="padding: 1rem 5rem; margin-left: 1rem"
                    id="submit_event_proceed"
                    type="btn"
                    @click="addAddressDetails()"
                  >
                    <span
                      ><i v-if="isLoading" class="fa fa-spinner fa-spin"></i
                    ></span>
                    SAVE & PROCEED
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import MapView from "../../common/mapView.vue";
import Phone from "../../common/Phone.vue";
import Izitoast from "../../mixins/IziToast";
import Request from "../../mixins/requestHelper";
export default {
  name: "address",
  props: ["changeFormStage", "editData", "id"],
  data() {
    return {
      phone: "",
      isLoading: false,
      isLoadingExit: "",
      districts: [],

      subCountyData: [],
        // village: "",
        // sub_county: "",
        // parish: "",
      parishes: [],
      villages: [],
      form_stage: 0,
    };
  },
  mixins: [Izitoast],
  components: { Phone, MapView },

  mounted() {
    const app = this;

    // alert(JSON.stringify(app.editData));
    if (app.editData.house_hold_info) {
      app.formData = JSON.parse(app.editData.address);
      //alert(JSON.stringify(app.formData))
    }
  },

  watch: {
    editData: function (newVal) {
      const app = this;
      // alert("Ok")
      // alert(JSON.stringify(app.editData));
      if (newVal && app.editData.address) {
        app.formData = JSON.parse(app.editData.address);

        //alert(JSON.stringify(app.formData))
        app.getSubCounty();
        app.getParish();
        app.getVillage();
      }
    },
  },
  methods: {
    clickEventTrigger() {
      const app = this;
      var forms = document.querySelectorAll(".needs-validation");

      var btn = document.getElementById("submit_event_proceed");
      // Loop over them and prevent submission
      Array.prototype.slice.call(forms).forEach(function (form) {
        btn.addEventListener("click", app.handleListener(event, form), false);
      });
    },
    //set location address

    onSetEvent(val) {
      const app = this;
      app.address = val;
    },
  
    getDistricts() {
      //alert("Ok");
      const app = this;
      Request.getMethod("/api/enumerator/get-member-district")
        .then((response) => {
          console.log(response);
          app.districts = response.data;
        })
        .catch((error) => {
          //console.log(error.response);
        });
    },

    //get  sub county under selected district
    getSubCounty() {
      const app = this;

      const val = app.district;

      app.parishes = [];
      app.villages = [];
      app.subCountyData = [];

      Request.getMethod(`/api/enumerator/get-member-sub-county/${val}`)
        .then((response) => {
          //console.log(response);
          app.subCountyData = response.data;
        })
        .catch((error) => {
          //console.log(error.response);
        });
    },

    //get parish after selecting sub country

    getParish() {
      let app = this;
      let form = $("#collect-data");
      app.parishes = [];
      let formData = new FormData();
      formData.append("sub_county", app.sub_county);
      formData.append("district", app.district);

      // Request.postMethod("/api/enumerator/get-member-parish", app.formData)
      //   .then((response) => {
      //     app.parishes = response.data;
      //     console.log(response);
      //   })
      //   .catch((error) => {
      //     console.log(error);
      //   });
        $.ajax({
          url: `/api/get-member-parish`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success(response) {
          app.parishes = response;
          console.log(parishes);
          },
        }); 
    },

    getVillage() {
      let app = this;
      let form = $("#collect-data");
      app.villages = [];
      let formData = new FormData();
      formData.append("sub_county", app.sub_county);
      formData.append("district", app.district);
      formData.append("parish", app.parish);

      // Request.postMethod("/api/get-member-village", app.formData)
      //   .then((response) => {
      //     app.village = response.data;
      //   })
      //   .catch((error) => {});

        $.ajax({
          url: `/api/get-member-village`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success(response) {
            app.villages = response;
          console.log(response);
          },
        }); 
    },

    handleListener(event, form) {
      const app = this;
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add("was-validated");
        //alert(app.field_validation);

        //var elmntToView = document.getElementById("to_top_page");

        //elmntToView.scrollIntoView();

        //alert("Perfect");
        app.showErrorMessage(
          "Please make sure to fill all the required fields !"
        );

        return;
      }

      //alert("Not Perfect")

      form.classList.add("was-validated");
      // app.isLoading = true;

      app.saveProfile();
      event.preventDefault();
      event.stopPropagation();
    },
    addAddressDetails() {
      let app = this;
      let form = $("#collect-data");

      if (form) {
        app.isLoading = true;

        let formData = new FormData();
        formData.append('village', app.village);
        formData.append('district', app.district);
        formData.append('sub_county', app.sub_county);
        formData.append('parish', app.parish);
        formData.append('names', app.names);
        formData.append('email', app.email);
        formData.append('address', app.address);
        formData.append('collection_date', app.collection_date);
        formData.append('form_stage', 1);
        formData.append('id', app.id);

      //   const body = {
      //   formDetails: formData,
      //   form_stage: 1,
      //   id: app.id,
      // };

      // Request.postMethod("/api/enumerator/save-data", body)
      //   .then((response) => {
      //     //console.log(response);
      //     var profile = response.data;
      //     profile.form_stage = 2;
      //     app.changeFormStage(profile);
      //     app.isLoading = false;
      //     app.showSuccessMessage("Profile Saved");
      //   })
      //   .catch((error) => {
      //     console.log(error.response);
      //     app.isLoading = false;

      //     app.showErrorMessage("Something went, please try again latter");
      //   });

        $.ajax({
          url: `/api/save-farmer-profile`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
              success(response) {
          var profile = response;
          form_stage = 2;
          app.changeFormStage(form_stage);

          app.isLoading = false;
          app.showSuccessMessage("Profile Saved");
          },
        });      
      }
    },

    saveProfile() {
      const app = this;

      const body = {
        formDetails: JSON.stringify(app.formData),
        form_stage: 1,
        id: app.id,
      };

      app.isLoading = true;

      Request.postMethod("/api/enumerator/save-profile", body)
        .then((response) => {
          //console.log(response);
          var profile = response.data;
          profile.form_stage = 2;
          app.changeFormStage(2);
          app.isLoading = false;
          app.showSuccessMessage("Profile Saved");
        })
        .catch((error) => {
          console.log(error.response);
          app.isLoading = false;

          app.showErrorMessage("Something went, please try again latter");
        });
    },
  },

  created() {
    const app = this;

    //get  districts
    app.getDistricts();
  },
};
</script>

<style scoped>
select {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 0.75rem center;
  background-size: 16px 12px;
}

label {
  font-size: 12pt !important;
}
</style>
