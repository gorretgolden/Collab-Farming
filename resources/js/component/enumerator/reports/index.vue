<template>
  <div class="d-flex" v-cloak>
    <side-navigation />

    <div id="page-content-wrapper">
      <enum-header />

      <div class="content-padding mt-4">
        <div class="cp-card">
          <div class="card-body" style="min-height: 70vh">
            <!--Super admin management-->
            <div style="padding-left: 1rem; padding-right: 1rem">
              <TableContent :content="content" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import sideNavigation from "../../Layout/enumeratorLayout/sideNavigation.vue";
import enumHeader from "../../Layout/enumeratorLayout/header.vue";
import Request from "../../mixins/requestHelper";
import TableContent from "./table.vue";

export default {
  components: { sideNavigation, enumHeader, TableContent },
  name: "report-index",

  data() {
    return {
      content: [],
    };
  },

  created() {
    const app = this;
    app.getProfileRecord();
  },

  methods: {
    getProfileRecord() {
      const app = this;

      Request.getMethod("/api/enumerator/get-reports")
        .then((response) => {
          app.content = response.data;

          console.log(app.content);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
};
</script>
