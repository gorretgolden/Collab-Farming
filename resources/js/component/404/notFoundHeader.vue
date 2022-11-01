<template>
  <nav class="navbar navbar-expand-md shadow-sm" style="background: white">
    <div class="container-fluid px-4">
      <router-link class="navbar-brand" to="/">
        <img class="img-logo" src="images/icon/logo2.png" height="40"/>
      </router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="{{ __('Toggle navigation') }}"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto"></ul>

        <!-- Right Side Of Navbar -->
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
                @click.prevent="openOrCloseMenu()"
                href="#"
                style="font-size: 22px"
                ><i class="fa fa-bars" style="color: #999999"></i
              ></a>
              <MenuList />
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import Request from "../mixins/requestHelper";
import MenuList from "../Layout/farmerLayout/menuList.vue";

export default {
  name: "not-found-header",
  components: { MenuList },
  data() {
    return {
      user: {},
    };
  },
  mounted() {
    const app = this;
    app.user = Request.getUser();
  },

  methods: {
    openOrCloseMenu() {
      $("#cp-nav-menu-enum").toggle();
    },
  },
};
</script>
