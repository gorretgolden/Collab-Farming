<template>
  <div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading d-flex justify-content-center">
      <router-link to="/" class="d-contents">
        <img
          src="images/icon/logo.png"
       
        />
      </router-link>
    </div>
    <div class="list-group list-group-flush mt-2">
      <router-link class="list-group-item" to="/fanmis-enumerator">
        <div class="row">
          <div class="col-sm-1">
            <i class="fas fa-home" style="color:goldenrod !important;"></i>
          </div>
          <div class="col-sm-9">
            <span>Home</span>
          </div>
        </div>
      </router-link>
      <router-link class="list-group-item" to="/enumerator-reports">
        <div class="row">
          <div class="col-sm-1">
            <i class="fas fa-user-friends" style="color:goldenrod !important;"></i>
          </div>
          <div class="col-sm-9">
            <span>Reports</span>
          </div>
        </div>
      </router-link>
   
    </div>
  </div>
</template>

<script>
export default {
  name: "side-nav",
};
</script>