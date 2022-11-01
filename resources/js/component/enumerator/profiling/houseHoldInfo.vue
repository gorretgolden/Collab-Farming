<template>
  <form
    @submit.prevent=""
    id="collect-data"
    class="needs-validation"
    novalidate
  >
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
                  <label for="respondent">6. Name of Respondent</label>
                  <input
                    type="text"
                    class="form-control col-6"
                    id="respondent"
                    aria-describedby="UserName"
                    v-model="formData.names"
                    placeholder="Names"
                    required
                  />
                </div>

                <div class="form-group">
                  <label for="email">7. Respondent's Gender</label>
                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="gender"
                      id="genderMale"
                      v-model="formData.respondents_gender"
                      value="Male"
                      required
                    />
                    <label class="form-check-label" for="genderMale">
                      Male
                    </label>
                  </div>

                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="gender"
                      id="genderFemale"
                      v-model="formData.respondents_gender"
                      value="Female"
                      required
                    />
                    <label class="form-check-label" for="genderFemale">
                      Female
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="date">8. Respondent's Date of Birth</label>
                  <input
                    type="date"
                    class="form-control col-6"
                    id="date"
                    aria-describedby="Date"
                    v-model="formData.respondents_date_of_birth"
                    placeholder="date"
                    required
                  />
                </div>

                <div class="form-group">
                  <label for="email"
                    >9. Is Respondent Owner of the enterprise?</label
                  >
                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="owenr_of_enterprise"
                      id="owenr_of_enterprise-yes"
                      :value="1"
                      required
                      v-model="formData.is_respondent_owner_of_enterprise"
                    />
                    <label
                      class="form-check-label"
                      for="owenr_of_enterprise-yes"
                    >
                      Yes
                    </label>
                  </div>

                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="owenr_of_enterprise"
                      id="owenr_of_enterprise-no"
                      v-model="formData.is_respondent_owner_of_enterprise"
                      :value="0"
                      required
                    />
                    <label
                      class="form-check-label"
                      for="owenr_of_enterprise-no"
                    >
                      No
                    </label>
                  </div>
                </div>

                <div
                  class="form-group"
                  v-if="formData.is_respondent_owner_of_enterprise == 0"
                >
                  <label for="Subcounty"
                    >10. If No, state the relationship to owner of the
                    enterprise</label
                  >
                  <select
                    class="form-control col-6"
                    id="Subcounty"
                    v-model="formData.relationship_to_owner"
                    required
                  >
                    <option value="">Select</option>
                    <option value="Spouse">Spouse</option>
                    <option value="Son/Daughter">Son/Daughter</option>
                    <option value="Father/Mother">Father/Mother</option>
                    <option value="Son/Daughter in law">
                      Son/Daughter in law
                    </option>
                    <option value="Grandchild">Grandchild</option>
                    <option value="Other Relative">Other Relative</option>
                    <option value="">Hired Worker</option>
                    <option value="Hired Worker">Other Specify</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="date-owner"
                    >11. Date of Birth of the owner of the enterprise
                  </label>
                  <input
                    type="date"
                    required
                    class="form-control col-6"
                    v-model="formData.enterprise_owner_date_of_birth"
                    id="date-owner"
                    aria-describedby="Date"
                    placeholder="date"
                  />
                </div>

                <div class="form-group">
                  <label for="gender-owenr"
                    >12. Gender of enterprise owner</label
                  >
                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      required
                      type="radio"
                      name="enterprise_owner_gender"
                      id="enterprise_owner_gender-male"
                      v-model="formData.enterprise_owner_gender"
                      value="Male"
                    />
                    <label
                      class="form-check-label"
                      for="enterprise_owner_gender-male"
                    >
                      Male
                    </label>
                  </div>

                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      required
                      name="enterprise_owner_gender"
                      id="enterprise_owner_gender-female"
                      value="Female"
                      v-model="formData.enterprise_owner_gender"
                    />
                    <label
                      class="form-check-label"
                      for="enterprise_owner_gender-female"
                    >
                      Female
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="marital"
                    >13. Marital Status of the enterprise owner</label
                  >
                  <select
                    v-model="formData.enterprise_owner_marital_status"
                    class="form-control col-6"
                    id="marital"
                    required
                  >
                    <option value="">Select</option>

                    <option value="Married but spouse away">
                      Married but spouse away
                    </option>
                    <option value=">Married living with spouse">
                      Married living with spouse
                    </option>

                    <option value="Separted/Dirvorced">
                      Separted/Dirvorced
                    </option>

                    <option value="Widow/Widower">Widow/Widower</option>
                    <option value="Not Married">Not Married</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="level-education"
                    >14. Level of Education of the enterprise owner
                  </label>
                  <select
                    v-model="formData.enterprise_owner_education_level"
                    required
                    class="form-control col-6"
                    id="level-education"
                  >
                    <option value="">Select</option>
                    <option value="No formal Education">
                      No formal Education
                    </option>
                    <option value="Primary">Primary</option>
                    <option value="O Level">O Level</option>
                    <option value="A Level">A Level</option>
                    <option value="University or tertiary (diploma, degree)">
                      University or tertiary (diploma, degree)
                    </option>
                    <option value="Post graduate (Masters / PHD)">
                      Post graduate (Masters / PHD)
                    </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="house-type"
                    >15. Type of house for the enterprise owner</label
                  >
                  <select
                    v-model="formData.enterprise_owner_house_type"
                    required
                    class="form-control col-6"
                    id="house-type"
                  >
                    <option value="">Select</option>
                    <option value="Permanent">Permanent</option>
                    <option value="Semi Permanent">Semi Permanent</option>
                    <option value="Temporarily">Temporarily</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="roof-type">16. Type of roofing</label>
                  <select
                    v-model="formData.enterprise_owner_roofing_type"
                    required
                    class="form-control col-6"
                    id="roof-type"
                  >
                    <option value="">Select</option>
                    <option value="Straw/Thatch">Straw/Thatch</option>
                    <option value="wood/planks">wood/planks</option>
                    <option value="tiles">tiles</option>

                    <option value="iron sheets">iron sheets</option>
                    <option value="asbestos">asbestos</option>
                    <option value="tin">tin</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="house-type"
                    >17. Religion of the enterprise owner</label
                  >
                  <select
                    class="form-control col-6"
                    id="house-type"
                    v-model="formData.enterprise_owner_religion"
                    required
                  >
                    <option value="">Select</option>
                    <option value="No religion/atheist">
                      No religion/atheist
                    </option>
                    <option value="Orthodox Christian">
                      Orthodox Christian
                    </option>
                    <option value="Catholic">Catholic</option>
                    <option value="Protestant">Protestant</option>

                    <option value="Catholic">Other Christian</option>
                    <option value="Protestant">Muslim</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="phone"
                    >18. Registered phone number of enterprise owner</label
                  >

                  <div style="width: 50%; margin-bottom: -1rem">
                    <phone
                      :inputId="'phone-id'"
                      :value="formData.phone"
                      name="phone"
                      :setPhoneValue="(val) => setPhoneValue(val)"
                    />
                  </div>
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
                    @click="clickEventTrigger()"
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
      formData: {
        relationship_to_owner: "",
        enterprise_owner_marital_status: "",
        enterprise_owner_education_level: "",
        enterprise_owner_house_type: "",
        enterprise_owner_roofing_type: "",
        enterprise_owner_religion: "",
      },
    };
  },
  mixins: [Izitoast],
  components: { Phone, MapView },

  mounted() {
    const app = this;

    // alert(JSON.stringify(app.editData));
    if (app.editData.house_hold_info) {
      app.formData = JSON.parse(app.editData.house_hold_info);
      //alert(JSON.stringify(app.formData))
    }
  },

  watch: {
    editData: function (newVal) {
      const app = this;

      // alert(JSON.stringify(app.editData));
      if (newVal && app.editData.house_hold_info) {
        app.formData = JSON.parse(app.editData.house_hold_info);

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

    setPhoneValue(val) {
      const app = this;
      app.formData["enterprise_phone"] = val;
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
        form_stage: 2,
        id: app.id,
      };

      app.isLoading = true;

      Request.postMethod("/api/enumerator/save-profile", body)
        .then((response) => {
          console.log(response);
          var profile = response.data;
          profile.form_stage = 3;
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
  