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
                <p class="h2" style="font-weight: 380">
                  Access to Market Information, Savings and Extension Services
                </p>
                <hr />

                <div class="form-group">
                  <label for="Village"
                    >37. Where do you primarily obtain market Information on price
                    eggs?</label
                  >
                  <select
                    class="form-control col-6"
                    id="Village"
                    v-model="formData.market_information"
                    required
                  >
                    <option value="">Select</option>
                    <option value="Other Farmers">Other Farmers</option>
                    <option value="Family and friends">Family and friends</option>
                    <option value="Radio/TV">Radio/TV</option>
                    <option value="Farmer Organization/Cooperative">Farmer Organization/Cooperative</option>
                    <option value="Other non farmer associations">Other non farmer associations</option>
                    <option value="Market place posters/posted bulletin">Market place posters/posted bulletin</option>
                    <option value="Agricultural traders">Agricultural traders</option>
                    <option value="SMS messages">SMS messages</option>
                    <option value="Internet">Internet</option>
                    <option value="Newspaper">Newspaper</option>
                    <option value="Extension officer">Extension officer</option>
                  </select>
                </div>

                <div class="form-group">
                  <label
                    >38. Do you belong to any savings group or
                    organization?</label
                  >
                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="gender"
                      id="owner-yes"
                      v-model="formData.belongs_to_saving_group"
                      :value="1"
                      required
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
                      v-model="formData.belongs_to_saving_group"
                      required
                    />
                    <label class="form-check-label" for="owner-no"> No </label>
                  </div>
                </div>

                <div class="form-group" v-if="formData.belongs_to_saving_group==1">
                  <label for="major_challenges"
                    >39. Indicate which savings group you belong to and the
                    type?</label
                  >

                  <div
                    style="display: flex"
                    v-for="(c, index) in formData.saving_group"
                    :key="index + 'savings-group'"
                    class="mt-2"
                  >
                    <input
                      type="text"
                      class="form-control col-6"
                      id="major_challenges"
                      aria-describedby="major_challenges"
                      v-model="formData.saving_group[index].group"
                      placeholder="  Name of the savings group"
                      required
                    />

                    <select
                      class="form-control ml-2 col-4"
                      v-model="formData.saving_group[index].type"
                      required
                    >
                      <option value="">Select Type</option>
                      <option value="VSLA">VSLA</option>
                      <option value="SACCO">SACCO</option>
                      <option value="NGO">NGO</option>
                      <option value=" Bank or micro-finance institution"> Bank or micro-finance institution</option>
                      <option value="Cash rounds">Cash rounds</option>
                    </select>

                    <div
                      class="form-control col-1"
                      style="
                        background: #f2f2f4;
                        text-align: center;
                        margin-left: 1rem;
                        cursor: pointer;
                      "
                      v-if="formData.saving_group.length - 1 == index"
                      @click="addSavingsGroup"
                      placeholder=""
                    >
                      <i style="color: #0050ad" class="fas fa-plus"></i>
                    </div>
                    <div
                      class="form-control col-1"
                      style="
                        background: #f2f2f4;
                        text-align: center;
                        margin-left: 1rem;

                        cursor: pointer;
                      "
                      v-if="formData.saving_group.length - 1 != index"
                      @click="removeGroupSource(index)"
                      placeholder=""
                    >
                      <i
                        class="far fa-trash-alt"
                        style="color: #999; font-size: 18px"
                      ></i>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label
                    >40. Did anyone in your household consult an agricultural
                    extension agent or Veterinary Service provider for advice
                    during the last 12 months to seek advice or assistance on
                    egg production and/marketing ?</label
                  >
                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="consult"
                      id="owner-yes-consult"
                      v-model="formData.consultation"
                      :value="1"
                    />
                    <label class="form-check-label" for="owner-yes-consult">
                      Yes
                    </label>
                  </div>

                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="consult"
                      id="owner-no-consult"
                      v-model="formData.consultation"
                      :value="0"
                    />
                    <label class="form-check-label" for="owner-no-consult">
                      No
                    </label>
                  </div>
                </div>

                <div class="form-group" v-if="formData.consultation == 1">
                  <label for="number_of_consult"
                    >41. If Yes, How many times during the last 12 months did
                    members of your household consult</label
                  >
                  <input
                    type="number"
                    class="form-control col-6"
                    v-model="formData.consultation_number"
                    id="number_of_consult"
                    aria-describedby="UserName"
                    placeholder="0"
                  />
                </div>
                <div class="form-group">
                  <label for="trays_of_eggs_weekly"
                    >42. What kind of assistance or Information was
                    requested?</label
                  >

                  <label class="box"
                    >(a) Farm Managment Practices
                    <input
                      type="checkbox"
                      name="current_market"
                      value=" Farm Managment Practices"
                      v-model="formData.information_requested"
                      required
                    />
                    <span class="mark"></span>
                  </label>

                  <label class="box"
                    >(b) Use of improved poultry breeds
                    <input
                      type="checkbox"
                      name="current_market"
                      value="Use of improved poultry breeds"
                      v-model="formData.information_requested"
                      required
                    />
                    <span class="mark"></span>
                  </label>

                  <label class="box"
                    >(c) Marketing
                    <input
                      type="checkbox"
                      name="current_market"
                      value="Marketing"
                      v-model="formData.information_requested"
                      required
                    />
                    <span class="mark"></span>
                  </label>

                  <label class="box"
                    >(d) Financial Related
                    <input
                      type="checkbox"
                      value="Financial Related"
                      name="current_market"
                      v-model="formData.information_requested"
                      required
                    />
                    <span class="mark"></span>
                  </label>

                  <label class="box" style="display: flex"
                    >(e) others
                    <input
                      type="checkbox"
                      value="others"
                      name="current_market"
                      v-model="formData.information_requested"
                      required
                    />
                    <span class="mark"></span>
                    <input
                      type="text"
                      class="form-control ml-2 col-6"
                      id="others"
                      aria-describedby="UserName"
                      v-model="formData.information_requested[5]"
                      v-if="formData.information_requested.includes('others')"
                      placeholder="Others"
                      required
                    />
                  </label>
                </div>

                <div class="form-group">
                  <label for="trainees"
                    >43. In which aspects of egg production and marketing would
                    you like to be trained, to better achieve your dreams for
                    this business?</label
                  >

                  <div
                    style="display: flex"
                    v-for="(c, index) in formData.training"
                    :key="index + 'training'"
                    class="mt-2"
                  >
                    <input
                      type="text"
                      class="form-control col-10"
                      id="trainees"
                      aria-describedby="trainees"
                      placeholder="  Required Training "
                      v-model="formData.training[index].value"
                      required
                    />

                    <div
                      class="form-control col-1"
                      style="
                        background: #f2f2f4;
                        text-align: center;
                        margin-left: 1rem;
                        cursor: pointer;
                      "
                      v-if="formData.training.length - 1 == index"
                      @click="addTraining"
                      placeholder=""
                    >
                      <i style="color: #0050ad" class="fas fa-plus"></i>
                    </div>
                    <div
                      class="form-control col-1"
                      style="
                        background: #f2f2f4;
                        text-align: center;
                        margin-left: 1rem;

                        cursor: pointer;
                      "
                      v-if="formData.training.length - 1 != index"
                      @click="removeTrainingSource(index)"
                      placeholder=""
                    >
                      <i
                        class="far fa-trash-alt"
                        style="color: #999; font-size: 18px"
                      ></i>
                    </div>
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
  name: "savings",
  props: ["changeFormStage","editData", "id"],
  data() {
    return {
      phone: "",
      isLoading: false,
      isLoadingExit: false,
      formData: {
        information_requested: [],
        training: [
          {
            value: "",
          },
        ],

        market_information: "",
        saving_group: [
          {
            group: "",
            type: "",
          },
        ],
      },
    };
  },
  mixins: [Izitoast],
  components: { Phone, MapView },
  mounted() {
    const app = this;

   // alert(JSON.stringify(app.editData.savings));
    if (app.editData.savings) {
    
      app.formData = JSON.parse(app.editData.savings);
      //alert(JSON.stringify(app.formData))
    }
  },

  watch: {
    editData: function (newVal) {
      const app = this;
      // alert(JSON.stringify(app.editData));
      if (newVal&&app.editData.savings) {
        
        app.formData = JSON.parse(app.editData.savings);

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

    addSavingsGroup() {
      const app = this;
      var data = app.formData["saving_group"];
      data.push({
        group: "",
        type: "",
      });
      app.formData["income"] = data;
    },
    removeGroupSource(index) {
      const app = this;
      var data = app.formData["saving_group"];
      data.splice(index, 1);
      app.formData["income"] = data;
    },

    addTraining() {
      const app = this;
      //console.log(app.formData)
      var data = app.formData["training"];

      //console.log(data)
     // alert("Ok")
      data.push({
        value: "",
      });
      app.formData["income"] = data;
    },
    removeTrainingSource(index) {
      const app = this;
      var data = app.formData["training"];
      data.splice(index, 1);
      app.formData["training"] = data;
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
        form_stage: 7,
        id: app.id,
      };

      app.isLoading = true;

      Request.postMethod("/api/enumerator/save-profile", body)
        .then((response) => {
          app.showSuccessMessage("Profile Saved");

          Swal.fire({
            title: "Cooperative Profile Saved",
            icon: "success",
            confirmButtonColor: "#006D5A",
            confirmButtonText: "OK",
          }).then(function () {
            window.location.href = "/enumerator-reports";
          });
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
        