<template>
  <div class="d-flex" v-cloak>
    <side-navigation />
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <admin-header />

      <div class="content-padding">
        <admin-dash-board-content />
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
</template>

<script>
//import Menu from '../Layout/menuList.vue';
import MenuList from "../Layout/adminLayout/menuList.vue";
import SideNavigation from "../Layout/adminLayout/sideNavigation.vue";
import Request from "../mixins/requestHelper";
import AdminDashBoardContent from "./adminDashBoardContent.vue";
import AdminHeader from "../Layout/adminLayout/header.vue";

export default {
  name: "admin-dashboard",

  data() {
    return {
      user: {},
    };
  },
  components: { MenuList, SideNavigation, AdminDashBoardContent, AdminHeader },

  mounted() {
   

    //console.log(Request.getUser().name)

    // app.getUser();
    // alert("Ok")
  },

  methods: {
    getUser() {
      //alert("Ok")

      Request.getMethod("/api/user")
        .then((response) => {
          //console.log(response);
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

   
  },
};
</script>