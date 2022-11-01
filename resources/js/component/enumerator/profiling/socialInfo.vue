<template>
  <form id="collect-data" class="needs-validation" novalidate>
    <div class="cp-card" style="margin: 1rem 0rem 0 2rem; padding: 1rem">
      <div id="step0-view" class="content">
        <div class="">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <p class="h2" style="font-weight: 380">
                  Respondent and general household information
                </p>
                <hr />

                <div class="form-group">
                  <label for="email"
                    >19. Do you belong to any agriculturally oriented group(s) in
                    this area</label
                  >
                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="gender"
                      id="owner-yes"
                      :value="1"
                      v-model="formData.agric_oriented_group"
                    />
                    <label class="form-check-label" for="owner-yes">
                      Yes
                    </label>
                  </div>

                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="gender"
                      id="owner-no"
                      :value="0"
                      v-model="formData.agric_oriented_group"
                    />
                    <label class="form-check-label" for="owner-no"> No </label>
                  </div>
                </div>

                <div
                  class="form-group"
                  v-if="formData.agric_oriented_group == 1"
                >
                  <label for="Subcounty">20. If Yes, What are the benefits?</label>

                  <input
                    type="text"
                    class="form-control col-6"
                    id="respondent"
                    aria-describedby="UserName"
                    v-model="formData.benefits"
                    placeholder="Benefits"
                  />
                </div>
                <div
                  class="form-group"
                  v-if="formData.agric_oriented_group == 1"
                >
                  <label for="if-yes"
                    >21. If yes, is the group specific for poultry farmers?</label
                  >
                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="is_poultry_farmers"
                      id="is_poultry_farmers-yes"
                      v-model="formData.is_poultry_farmers"
                      :value="1"
                    />
                    <label class="form-check-label" for="is_poultry_farmers-yes"> Yes </label>
                  </div>

                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="is_poultry_farmers"
                      id="is_poultry_farmers-no"
                      :value="0"
                      v-model="formData.is_poultry_farmers"
                    />
                    <label class="form-check-label" for="is_poultry_farmers-no"> No </label>
                  </div>
                </div>

                <div
                  class="form-group"
                  v-if="formData.agric_oriented_group == 0"
                >
                  <label for="Subcounty">22. If No, Why?</label>

                  <input
                    type="text"
                    class="form-control col-6"
                    id="why-no"
                    aria-describedby="UserName"
                    v-model="formData.why"
                    placeholder="Why"
                  />
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
                    @click="clickEventTrigger()"
                    id="submit_event_proceed"
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
  name: "house-hold-info",
  props: ["changeFormStage", "id", "editData"],
  data() {
    return {
      phone: "",
      isLoading: false,
      isLoadingExit: false,
      formData: {},
    };
  },
  components: { Phone, MapView },
  mixins: [Izitoast],


  mounted() {
    const app = this;

    // alert(JSON.stringify(app.editData));
    if (app.editData.social_info) {
      app.formData = JSON.parse(app.editData.social_info);
      //alert(JSON.stringify(app.formData))
    }
  },


  watch: {
    editData: function (newVal) {
      const app = this;
     // alert(JSON.stringify(app.editData));
      if (newVal&&app.editData.social_info) {
        app.formData = JSON.parse(app.editData.social_info);

        //alert(JSON.stringify(app.formData))
   
        
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


    saveProfile() {
      const app = this;

      const body = {
        formDetails: JSON.stringify(app.formData),
        form_stage: 3,
        id: app.id,
      };

      app.isLoading = true;
      

      Request.postMethod("/api/enumerator/save-profile", body)
        .then((response) => {
          console.log(response);
          var profile = response.data;
          profile.form_stage = 4;
          app.changeFormStage(profile);
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
};
</script>
    
    <style scoped>
select {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 0.75rem center;
  background-size: 16px 12px;
}

input[type="radio"] {
  display: none;
}

input[type="radio"] + label:before {
  content: "";
  display: inline-block;
  width: 30px;
  height: 30px;
  padding: 6px;
  margin-right: 4px;
  background-clip: content-box;
  border: 1px solid #448b51;

  border-radius: 50%;
}

input[type="radio"]:checked + label:before {
  background-color: #448b51;
}

input[type="checkbox"] {
  display: none;
}

input[type="checkbox"] + label:before {
  content: "";
  display: inline-block;
  width: 25px;
  height: 25px;
  padding: 6px;
  margin-right: 4px;
  background-clip: content-box;
  border: 1px solid #448b51;
  background-color: #ffffff;

  border-radius: 6px;
  margin-top: 5px;
}

.arrow {
  font-size: 20px;
}

.title_aligin {
  display: flex;
}

label {
  display: flex;
  align-items: center;
  margin-left: 2px;
  margin-bottom: 0.2 !important;
}

.padding_top_item {
  padding-bottom: 0.2rem;
}

.col-5 {
  padding: 0 !important;
}

.box {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 15px;
  cursor: pointer;
  font-size: 16px;
}

input[type="checkbox"] {
  visibility: hidden;
}

.label_title {
  margin-bottom: 0 !important;
  font-size: 16px;
  font-weight: 400;
  margin-top: 0.5rem;
  color: #000000;
}

.form-check {
  padding-left: 0 !important;
}
.mark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  border: 1px solid #448b51;
  background-color: #ffffff;
  border-radius: 6px;
}

.box input:checked + .mark {
  background-color: #448b51;
}

.mark:after {
  content: "";
  position: absolute;
  display: none;
}

.box input:checked + .mark:after {
  display: block;
}

.box .mark:after {
  left: 8px;
  bottom: 5px;
  width: 6px;
  height: 12px;
  border: solid #eee;
  border-width: 0 4px 4px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

.invalid-feedback_custom {
  width: 100%;
  margin-top: 0.25rem;
  font-size: 80%;
  color: #e3342f;
}

.artist-collection-photo {
  float: left;
  margin: 10px;
  cursor: pointer;
  width: 170px;
  height: 150px;
  position: relative;
}

.close {
  position: absolute;
  top: 0;
  right: 0;
  z-index: 9999;
  font-size: 20px;
  color: red;
  margin-top: 5px;
  margin-right: 10px;
}

.img-thumbnail {
  opacity: 1;
  transition: opacity 0.25s ease-in-out;
  -moz-transition: opacity 0.25s ease-in-out;
  -webkit-transition: opacity 0.25s ease-in-out;
}

.img-thumbnail:hover {
  opacity: 0.5;
}
label {
  font-size: 12pt !important;
}
</style>
    