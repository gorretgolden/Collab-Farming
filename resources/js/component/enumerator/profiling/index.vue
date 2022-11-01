<template>
  <div class="d-flex" v-cloak>
    <side-navigation />

    <div id="page-content-wrapper">
      <enum-header />
      <div class="content-padding">
        <progress-indicator :step="step" />
        <AddressForm
          v-if="step == 1"
          :changeFormStage="(val) => changeFormStage(val)"
          :id="id"
          :editData="editData"
                  />
        <house-hold-info
          v-if="step == 2"
          :changeFormStage="(val) => changeFormStage(val)"
          :id="id"
          :editData="editData"
        />
        <SocialInfo
          v-if="step == 3"
          :changeFormStage="(val) => changeFormStage(val)"
          :editData="editData"
          :id="id"
        />

        <egg-production
          v-if="step == 4"
          :changeFormStage="(val) => changeFormStage(val)"
          :id="id"
          :editData="editData"
        />

        <Marketing
          v-if="step == 5"
          :changeFormStage="(val) => changeFormStage(val)"
          :id="id"
          :editData="editData"
        />

        <HouseHoldIncome
          v-if="step == 6"
          :changeFormStage="(val) => changeFormStage(val)"
          :id="id"
          :editData="editData"
        />

        <Savings
          v-if="step == 7"
          :changeFormStage="(val) => changeFormStage(val)"
          :id="id"
          :editData="editData"
        />
        
      </div>
    </div>
  </div>
</template>


<script>
import sideNavigation from "../../Layout/enumeratorLayout/sideNavigation.vue";
import enumHeader from "../../Layout/enumeratorLayout/header.vue";
import ProgressIndicator from "./progressIndicator.vue";
import AddressForm from "./address.vue";
import HouseHoldInfo from "./houseHoldInfo.vue";
import SocialInfo from "./socialInfo.vue";
import EggProduction from "./eggProduction.vue";
import Marketing from "./marketing.vue";
import HouseHoldIncome from "./houseHoldIncome.vue";
import Savings from "./savings.vue";
import Izitoast from "../../mixins/IziToast";
import Request from "../../mixins/requestHelper";
export default {
  components: {
    sideNavigation,
    enumHeader,
    ProgressIndicator,
    AddressForm,
    HouseHoldInfo,
    SocialInfo,
    EggProduction,
    Marketing,
    HouseHoldIncome,
    Savings,
  },
  name: "egg-producer-profiling",
  data() {
    return {
      step: 1,
      id: "",
      editData: false,
    };
  },
  mixins: [Izitoast],

  mounted() {},

  created() {
    const app = this;
    const id = this.$route.params.id;
    if (id) {
      app.getProfile(id);
    }
  },
  methods: {
    getProfile(id) {
      const app = this;
      Request.getMethod(`/api/enumerator/get-profile/${id}`)
        .then((response) => {
          app.editData = response.data;
          app.id = response.data.id;
        
          app.step =
            response.data.form_stage == 7 || response.data.form_stage == 0
              ? 1
              : response.data.form_stage;
           //console.log(response.data, '...')
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    prev() {
           this.step--;
       },
       next() {
           this.step++;
       },
    changeFormStage(obj) {
      const app = this;
      if (!app.id) {
        app.id = obj.id;
      }
      app.step = form_stage;
    },
  },
};
</script>

<style scoped>
label {
  font-size: 12pt !important;
}
</style>
