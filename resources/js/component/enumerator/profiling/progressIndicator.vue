<template>
  <div
    class="bs-stepper-header mb-2"
    style="justify-content: center; width: 100%"
  >
    <div class="progress-container">
      <div class="step" :data-target="`#step1-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 1 }"
          
        >
          <span class="bs-stepper-circle" v-if="step >= 1"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else> 1 </span>
          <br />
          <span class="label_member_add">Address</span>
        </button>
      </div>

      <div
        class="line_cooperative_ivan"
        :class="`active ${step >= 2 ? 'line-active' : ''}`"
        style="width: 4rem"
      ></div>

      <div class="step" :data-target="`#step2-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 2 }"
        >
          <span class="bs-stepper-circle" v-if="step >= 2"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else>2</span>
          <br />
          <span class="label_member_add">Household Information</span>
        </button>
      </div>
      <div
        class="line_cooperative_ivan"
        :class="`active ${step >= 3 ? 'line-active' : ''}`"
        style="width: 4rem"
      ></div>

      <div class="step" :data-target="`#step2-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 3 }"
        >
          <span class="bs-stepper-circle" v-if="step >= 3"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else>3</span>
          <br />
          <span class="label_member_add">Social Information</span>
        </button>
      </div>
      <div
        class="line_cooperative_ivan"
        :class="`active ${step >= 4 ? 'line-active' : ''}`"
        style="width: 4rem"
      ></div>

      <div class="step" :data-target="`#step2-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 4 }"
        >
          <span class="bs-stepper-circle" v-if="step >= 4"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else>4</span>
          <br />
          <span class="label_member_add">Egg Production</span>
        </button>
      </div>
      <div
        class="line_cooperative_ivan"
        :class="`active ${step >= 5 ? 'line-active' : ''}`"
        style="width: 4rem"
      ></div>

      <div class="step" :data-target="`#step2-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 5 }"
        >
          <span class="bs-stepper-circle" v-if="step >= 5"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else>5</span>
          <br />
          <span class="label_member_add">Marketing</span>
        </button>
      </div>
      <div
        class="line_cooperative_ivan"
        :class="`active ${step >= 6 ? 'line-active' : ''}`"
        style="width: 4rem"
      ></div>

      <div class="step" :data-target="`#step2-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 6 }"
        >
          <span class="bs-stepper-circle" v-if="step >= 6"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else>6</span>
          <br />
          <span class="label_member_add">Household Income</span>
        </button>
      </div>
      <div
        class="line_cooperative_ivan"
        :class="`active ${step >= 7 ? 'line-active' : ''}`"
        style="width: 4rem"
      ></div>

      <div class="step" :data-target="`#step2-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 7 }"
        >
          <span class="bs-stepper-circle" v-if="step >= 7"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else>7</span>
          <br />
          <span class="label_member_add">Savings</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProgressIndicator",
  props: ["step"],

  data() {
    return {};
  },
};
</script>

<style scoped>
.progress-container {
  display: flex;
  justify-content: center;
  align-items: center;
}
.line-active {
  background-color: #006d5c;
}
</style>
