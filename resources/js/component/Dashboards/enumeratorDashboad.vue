<template>
  <div class="d-flex" v-cloak>
    <side-navigation />
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <enum-header />

      <div class="content-padding">
        <enum-dash-board-content />
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
</template>

<script>
//import Menu from '../Layout/menuList.vue';
import MenuList from "../Layout/enumeratorLayout/menuList.vue";
import SideNavigation from "../Layout/enumeratorLayout/sideNavigation.vue";
import Request from "../mixins/requestHelper";
import EnumHeader from "../Layout/enumeratorLayout/header.vue";

import EnumDashBoardContent from "./enumDashBoardContent.vue";

export default {
  name: "enum-dashboard",

  data() {
    return {
      user: {},
    };
  },
  components: { MenuList, SideNavigation, EnumHeader, EnumDashBoardContent },

  mounted() {
    const app = this;
    app.user = Request.getUser();

    // app.getUser();
    // alert("Ok")
  },

  methods: {
    getUser() {
      //alert("Ok")

      Request.getMethod("/api/user")
        .then((response) => {
          console.log(response);
          if (response.data) {
            //localStorage.setItem("User", JSON.stringify(response.data));
            // app.isLoading = false;
            //this.$router.push({ path: "/", replace: true });
            // window.location.href='/';
          }
          // console.log(response)
        })
        .catch((error) => {
          console.log(error.response);
        });
    },

    openOrCloseMenu() {
      $("#cp-nav-menu-enum").toggle();
    },
  },
};
</script>