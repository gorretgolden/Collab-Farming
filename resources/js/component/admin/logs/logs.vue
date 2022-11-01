<template>
  <div>
    <not-found-header/>
    <div class="config-view">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <h4>Logs</h4>
          </div>
        </div>
        <div class="row mt-3 cp-card mx-1 cp-config p-0">
          <div class="col-md-3 p-0">
            <div class="sidebar p-0">
              <a @click.prevent="setActive" class="active" data-tab="0">
                <div
                  class="icon-wrapper"
                  style="margin-right: 8px !important"
                  @click.prevent="setActive"
                  data-tab="0"
                >
                  <i class="fas fa-envelope"></i>
                </div>
                <span class="cp-text-m" @click.prevent="setActive" data-tab="0"
                  >Emails Sent (agg.)</span
                >
              </a>

              <a @click.prevent="setActive" data-tab="1">
                <div
                  class="icon-wrapper"
                  style="margin-right: 8px !important"
                  @click.prevent="setActive"
                  data-tab="1"
                >
                  <i class="far fa-envelope"></i>
                </div>
                <span class="cp-text-m" @click.prevent="setActive" data-tab="1"
                  >Emails Sent (actual)</span
                >
              </a>

              <a @click.prevent="setActive" data-tab="2">
                <div
                  class="icon-wrapper"
                  style="margin-right: 8px !important"
                  @click.prevent="setActive"
                  data-tab="2"
                >
                  <i class="fas fa-lock"></i>
                </div>
                <span class="cp-text-m" @click.prevent="setActive" data-tab="2"
                  >Logins</span
                >
              </a>

              <a @click.prevent="setActive" data-tab="3">
                <div
                  class="icon-wrapper"
                  style="margin-right: 8px !important"
                  @click.prevent="setActive"
                  data-tab="3"
                >
                  <i class="fas fa-desktop"></i>
                </div>
                <span class="cp-text-m" @click.prevent="setActive" data-tab="3"
                  >Hits</span
                >
              </a>
            </div>
          </div>
          <div class="col-md-9 p-0 pb-6 pl-0 pr-0">
            <div class="content px-5 pt-2 pb-4" id="email-logs-content">
              <EmailsAggregated key="0" v-if="tab == 0" />
              <EmailsActual key="1" v-if="tab == 1" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import EmailsAggregated from "./EmailsAggregated";
import EmailsActual from "./EmailsActual";
import MenuList from '../../Layout/adminLayout/menuList.vue';
import NotFoundHeader from "../../404/notFoundHeader.vue";

export default {
  name: "Logs",
  components: { EmailsAggregated, EmailsActual, MenuList, NotFoundHeader },
  data() {
    return {
      tab: 0,
    };
  },
  methods: {
    setActive(e) {
      let app = this;
      let target = e.target;
      $(target).addClass("active").siblings().removeClass("active");
      $(target).parent("a").addClass("active").siblings().removeClass("active");

      if (
        parseInt($(target).attr("data-tab")) != NaN &&
        parseInt($(target).attr("data-tab")) != undefined
      ) {
        app.tab = parseInt($(target).attr("data-tab"));
      }
    },
  },
};
</script>

<style scoped>
</style>
