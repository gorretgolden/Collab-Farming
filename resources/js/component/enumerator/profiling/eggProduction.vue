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
                  Egg Production Information
                </p>
                <hr />

                <div class="form-group">
                  <label for="egg_date"
                    >23. When did you start egg production?</label
                  >

                  <input
                    type="date"
                    class="form-control col-6"
                    id="egg_date"
                    v-model="FormData.egg_production_date"
                    aria-describedby="egg_date"
                    required
                  />
                </div>

                <div class="form-group">
                  <label for="type_birds"
                    >24. Type of birds kept for egg laying</label
                  >
                  <select
                    class="form-control col-6"
                    v-model="FormData.type_of_birds"
                    id="type_birds"
                    required
                  >
                    <option value="">Select</option>
                    <option value="Dual purpose">Dual purpose</option>
                    <option value="Commercial Layers">Commercial Layers</option>
                    <option value="Indigenous">Indigenous</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="number_of_egg_laying_birds"
                    >25. Number of egg laying birds in terms of stock</label
                  >

                  <input
                    type="number"
                    v-model="FormData.number_of_egg_laying_birds"
                    class="form-control col-6"
                    id="number_of_egg_laying_birds"
                    aria-describedby="number_of_egg_laying_birds"
                    placeholder="Number"
                    required
                  />
                </div>

                <div class="form-group">
                  <label for="source_feeds_for_birds"
                    >26. What is the main source of feeds for the egg laying
                    birds?</label
                  >
                  <select
                    class="form-control col-6"
                    id="source_feeds_for_birds"
                    v-model="FormData.source_of_feeds"
                    required
                  >
                    <option value="">Select</option>
                    <option value="Home-made">Home-made</option>
                    <option value="Feeds manufacturer / agent (purchased)">
                      Feeds manufacturer / agent (purchased)
                    </option>
                    <option value="Both Home and purchased">
                      Both Home and purchased
                    </option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="source_of_birds"
                    >27. Source of Birds and Quality of stock</label
                  >

                  <div
                    style="display: flex"
                    v-for="(c, index) in FormData.source_of_birds"
                    :key="index + 'source_of_birds'"
                    class="mt-2"
                  >
                    <input
                      type="text"
                      class="form-control col-6"
                      id="source_of_birds"
                      aria-describedby="source_of_birds"
                      placeholder="Source of birds"
                      v-model="FormData.source_of_birds[index].source"
                      required
                    />
                    <select
                      class="form-control ml-2 col-4"
                      v-model="FormData.source_of_birds[index].quantity"
                      required
                    >
                      <option value="">Select</option>
                      <option value="Good">Good</option>
                      <option value="Not Good">Not Good</option>
                    </select>

                    <div
                      class="form-control col-1"
                      style="
                        background: #f2f2f4;
                        text-align: center;
                        margin-left: 1rem;
                        cursor: pointer;
                      "
                      v-if="FormData.source_of_birds.length - 1 == index"
                      @click="addBirdSource"
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
                      v-if="FormData.source_of_birds.length - 1 != index"
                      @click="removeBirdSource(index)"
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
                  <label for="number_of_cycles"
                    >28. How many cycles do you engage in per year?</label
                  >

                  <input
                    type="number"
                    class="form-control col-6"
                    id="number_of_cycles"
                    aria-describedby="number_of_cycles"
                    v-model="FormData.number_of_cycles"
                    placeholder="Cycles"
                    required
                  />
                </div>

                <div class="form-group">
                  <label for="records_kept_on_the_farm"
                    >29. What records do you keep at your farm?</label
                  >

                  <input
                    type="text"
                    class="form-control col-6"
                    id="records_kept_on_the_farm"
                    aria-describedby="records_kept_on_the_farm"
                    placeholder="Records"
                    v-model="FormData.records_kept_on_the_farm"
                    required
                  />
                </div>

                <div class="form-group">
                  <label for="labour_provider"
                    >30. Who provides the labour for managing the poulty operations
                    (Feeding, Cleaning, Egg collection)</label
                  >

                  <div
                    style="display: flex"
                    v-for="(c, index) in FormData.labour_provider"
                    :key="index + 'labour-force'"
                    class="mt-2"
                  >
                    <select
                      class="form-control col-6"
                      v-model="FormData.labour_provider[index].source"
                      required
                    >
                      <option value="">Select About Source</option>
                      <option value="Men">Men</option>
                      <option value="Women">Women</option>
                      <option value="Children">Children</option>
                      <option value="Permanent Labour">Permanent Labour</option>
                      <option value="Casual Labour">Casual Labour</option>
                    </select>
                    <select
                      class="form-control ml-2 col-4"
                      v-model="FormData.labour_provider[index].about_source"
                      required
                    >
                      <option value="">Select</option>
                      <option value="Frequent">Frequent</option>
                      <option value="Occassionally">Occassionally</option>
                    </select>

                    <div
                      class="form-control col-1"
                      style="
                        background: #f2f2f4;
                        text-align: center;
                        margin-left: 1rem;
                        cursor: pointer;
                      "
                      v-if="FormData.labour_provider.length - 1 == index"
                      @click="addLabourSource"
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
                      v-if="FormData.labour_provider.length - 1 != index"
                      @click="removeLabourSource(index)"
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
                  <label for="major_challenges"
                    >31. What are your major challenges and how do you address
                    them?</label
                  >

                  <div
                    style="display: flex"
                    v-for="(c, index) in FormData.challenges"
                    :key="index + 'challenges_solution'"
                    class="mt-2"
                  >
                    <input
                      type="text"
                      class="form-control col-5"
                      id="major_challenges"
                      aria-describedby="major_challenges"
                      placeholder="  Challenge"
                      v-model="FormData.challenges[index].challenge"
                      required
                    />

                    <input
                      type="text"
                      class="form-control ml-2 col-5"
                      id="major_challenges"
                      aria-describedby="major_challenges"
                      placeholder="  Solution"
                      v-model="FormData.challenges[index].solution"
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
                      v-if="FormData.challenges.length - 1 == index"
                      @click="addChallengeSource"
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
                      v-if="FormData.challenges.length - 1 != index"
                      @click="removeChallengeSource(index)"
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
  name: "egg-production",
  props: ["changeFormStage", "id", "editData"],

  data() {
    return {
      phone: "",
      isLoading: false,
      isLoadingExit: false,
      FormData: {
        labour_provider: [
          {
            about_source: "",
            source: "",
          },
        ],

        challenges: [
          {
            challenge: "",
            solution: "",
          },
        ],

        type_of_birds: "",
        source_of_feeds: "",
        source_of_birds: [
          {
            source: "",
            quantity: "",
          },
        ],
      },
    };
  },
  mixins: [Izitoast],
  components: { Phone, MapView },

  mounted() {
    const app = this;

    // alert(JSON.stringify(app.editData));
    if (app.editData.egg_production) {
      app.FormData = JSON.parse(app.editData.egg_production);
     // alert("Ok")
      //alert(JSON.stringify(app.formData))
    }
  },

  watch: {
    editData: function (newVal) {
      const app = this;
     // alert(JSON.stringify(app.editData));
      if (newVal&&app.editData.egg_production) {
        app.FormData = JSON.parse(app.editData.egg_production);

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

    addBirdSource() {
      const app = this;
      var data = app.FormData["source_of_birds"];
      data.push({
        source: "",
        quantity: "",
      });
      app.FormData["source_of_birds"] = data;
    },

    addLabourSource() {
      const app = this;
      var data = app.FormData["labour_provider"];
      data.push({
        source: "",
        about_source: "",
      });
      app.FormData["labour_provider"] = data;
    },

    addChallengeSource() {
      const app = this;
      var data = app.FormData["challenges"];
      data.push({
        challenge: "",
        solution: "",
      });
      app.FormData["challenges"] = data;
    },
    removeChallengeSource(index) {
      const app = this;
      var data = app.FormData["challenges"];
      data.splice(index, 1);
      app.FormData["challenges"] = data;
    },
    removeLabourSource(index) {
      const app = this;
      var data = app.FormData["labour_provider"];
      data.splice(index, 1);
      app.FormData["labour_provider"] = data;
    },

    removeBirdSource(index) {
      const app = this;
      var data = app.FormData["source_of_birds"];
      data.splice(index, 1);
      app.FormData["source_of_birds"] = data;
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
        formDetails: JSON.stringify(app.FormData),
        form_stage: 4,
        id: app.id,
      };

      app.isLoading = true;

  

      Request.postMethod("/api/enumerator/save-profile", body)
        .then((response) => {
          //console.log(response);
          var profile = response.data;
          profile.form_stage = 5;
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
      