<template>
  <form
    id="collect-data"
    class="needs-validation"
    @submit.prevent=""
    novalidate
  >
    <div class="cp-card" style="margin: 1rem 0rem 0 2rem; padding: 1rem">
      <div id="step0-view" class="content">
        <div class="">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <p class="h2" style="font-weight: 380">
                  Household Income during 2021
                </p>
                <hr />

                <div class="form-group">
                  <label for="Village"
                    >36. What are your priority sources of income?</label
                  >
                  <div
                  
                    v-for="(c, index) in formData.income"
                    :key="index + 'income_info'"
                    class="mt-2"
                  >
                    <select
                      class="form-control col-10"
                      id="Village"
                      v-model="formData.income[index].income_source"
                      required
                    >
                      <option value="">Select Income source</option>
                      <option value="Sales of Eggs">Sale of Eggs</option>
                      <option value="Sale of off-layers">
                        Sale of off-layers
                      </option>
                      <option value="Regular employment">
                        Regular employment
                      </option>
                      <option value="Running own bussiness">
                        Running own bussiness
                      </option>
                      <option value="Others">
                        Others(Sale of crops, livestock, poultry litter,
                        Remittances from family/other members )
                      </option>
                    </select>
                    <div style="display: flex" class="mt-2">
                      <select
                        class="form-control col-4"
                        v-model="formData.income[index].is_income_generating"
                        required
                      >
                        <option value="">
                          Do you get income from this source?
                        </option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>

                      <select
                        class="form-control ml-1 col-3"
                        v-model="formData.income[index].who_gets_it"
                        required
                      >
                        <option value="">Who gets it?</option>
                        <option value="Household head">Household head</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Other mebers">Other mebers</option>
                      </select>

                      <select
                        class="form-control ml-1 col-3"
                        v-model="formData.income[index].who_spents_it"
                        required
                      >
                        <option value="">Who spends it?</option>
                        <option value="Household head">Household head</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Other mebers">Other mebers</option>
                      </select>

                      <div
                        class="form-control col-1"
                        style="
                          background: #f2f2f4;
                          text-align: center;
                          margin-left: 1rem;
                          cursor: pointer;
                          margin-top: -20px;
                        "
                        v-if="formData.income.length - 1 == index"
                        @click="addIncomeSource"
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
                          margin-top: -20px;

                          cursor: pointer;
                        "
                        v-if="formData.income.length - 1 != index"
                        @click="removeIncomeSource(index)"
                        placeholder=""
                      >
                        <i
                          class="far fa-trash-alt"
                          style="color: #999; font-size: 18px"
                        ></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="text-center mx-auto"
                  style="
                    display: flex;

                    justify-content: center;
                    padding: 2rem;
                  "
                >
                  <button
                    :disabled="isLoading"
                    class="submit_event cp-btn"
                    style="
                      padding: 1rem 5rem;

                      background-color: #004e89;
                    "
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
import iziToast from "izitoast";
import MapView from "../../common/mapView.vue";
import Phone from "../../common/Phone.vue";
import Request from "../../mixins/requestHelper";
export default {
  name: "household-income",
  props: ["changeFormStage", "id", "editData"],
  data() {
    return {
      phone: "",
      isLoading: false,
      isLoadingExit: false,
      formData: {
        income: [
          {
            income_source: "",
            is_income_generating: "",
            who_gets_it: "",
            who_spents_it: "",
          },
        ],
      },
    };
  },
  mixins: [iziToast],
  components: { Phone, MapView },

  mounted() {
    const app = this;

    // alert(JSON.stringify(app.editData));
    if (app.editData.household_income) {
      app.formData = JSON.parse(app.editData.household_income);
      //alert(JSON.stringify(app.formData))
    }
  },

  watch: {
    editData: function (newVal) {
      const app = this;
      // alert(JSON.stringify(app.editData));
    //  alert("Ok")
      if (newVal && app.editData.household_income) {
    
        app.formData = JSON.parse(app.editData.household_income);

        //alert(JSON.stringify(app.formData))
      }
    },
  },
  methods: {
    addIncomeSource() {
      const app = this;
      var data = app.formData["income"];
      data.push({
        income_source: "",
        is_income_generating: "",
        who_gets_it: "",
        who_spents_it: "",
      });
      app.formData["income"] = data;
    },
    removeIncomeSource(index) {
      const app = this;
      var data = app.formData["income"];
      data.splice(index, 1);
      app.formData["income"] = data;
    },

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
        form_stage: 6,
        id: app.id,
      };

      app.isLoading = true;

      Request.postMethod("/api/enumerator/save-profile", body)
        .then((response) => {
          console.log(response);
          var profile = response.data;
          profile.form_stage = 7;
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

label {
  font-size: 12pt !important;
}
</style>
  