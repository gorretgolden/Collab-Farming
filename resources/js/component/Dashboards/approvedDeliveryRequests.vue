<template>
    <div class="d-flex" v-cloak>
      <side-navigation />
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav
          class="navbar navbar-expand-lg border-bottom shadow-sm"
          style="background: white"
        >
          <button key=""
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
  
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul
              class="navbar-nav ml-auto mt-2 mt-lg-0"
              style="position: absolute; right: 5%"
            >
              <li class="nav-item active">
                <a class="nav-link username-link text-muted mt-1" href="#"
                  >Welcome {{ user.name }}</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" style="font-size: 22px"
                  ><i class="fa fa-bell" style="color: #999999"></i
                ></a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  @click="openOrCloseMenu"
                  href="#"
                  style="font-size: 22px"
                  ><i class="fa fa-bars" style="color: #999999"></i
                ></a>
                <menu-list />
              </li>
            </ul>
          </div>
        </nav>
  
        <div class="content-padding">
          <approved-egg-delivery-requests />
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
  import ApprovedEggDeliveryRequests from './approvedEggDeliveryRequests.vue'
  
  export default {
    name: "approved-delivery-request",
  
    data() {
      return {
        user: {},
      };
    },
    components: { MenuList, SideNavigation, ApprovedEggDeliveryRequests },
  
    mounted() {
      const app = this;
      app.user = Request.getUser();
  
      // app.getUser();
      // alert("Ok")
    },
  
    methods: {
   
  
      openOrCloseMenu() {
        $("#cp-nav-menu-enum").toggle();
      },
    },
  };
  </script>