<template>
  <div class="cp-nav-menu shadow-sm" id="cp-nav-menu-enum" style="width: 480px">
    <div class="cp-menu-header" style="width: 480px">
      <h3 class="font-weight-normal">
        Menu
        <button
          type="button"
          style="
            position: absolute;
            font-size: 19px;
            right: 1.2rem;
            border: none;
            background: transparent;

            outline: none;
          "
          @click="openOrCloseMenu"
          class="float-right font-weight-normal"
        >
          &times;
        </button>
      </h3>
    </div>
    <div class="cp-menu-content">
      <div class="row cp-menu-row">
        <!--
        <div class="col-md">
          <a href="">
            <div class="cp-menu-item">
              <div class="cp-menu-icon">
                <i class="fas fa-file-alt"></i>
              </div>
              <div class="cp-menu-txt">
                <h3>Logs</h3>
                <p>Real-time updates</p>
              </div>
            </div>
          </a>
        </div>
        -->
        <div class="col-md">
          <a href="" @click.prevent="logoutUser">
            <div class="cp-menu-item">
              <div class="cp-menu-icon">
                <i class="fa fa-lock"></i>
              </div>
              <div class="cp-menu-txt">
                <h3>Logout</h3>
                <p>End session</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Request from "../../mixins/requestHelper";

export default {
  name: "menu-List",

  methods: {
    logoutUser() {
      Request.getMethod("/api/logout")
        .then((response) => {
          window.localStorage.removeItem("Token");
          window.localStorage.removeItem("User");
          this.$router.push({ path: "/login", replace: true });
        })
        .catch((error) => {
          console.log(error.response);
          window.localStorage.removeItem("Token");
          window.localStorage.removeItem("User");
          this.$router.push({ path: "/login", replace: true });
        });
    },

    openOrCloseMenu() {
      $("#cp-nav-menu-enum").toggle();
    },
  },
};
</script>