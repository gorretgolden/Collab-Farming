<template>
    <div class="d-flex" v-cloak>
      <side-navigation />
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav
          class="navbar navbar-expand-lg border-bottom shadow-sm"
          style="background: white"
        >
          <button
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
        <!-- egg weights tab -->
        <div class="w-100 bg-light">
            <div class="row">
                <div class="bg-light w-85 pt-2 h-100 ml-3 mt-2 ">
<div class="h-15 vw-90 d-flex flex-row align-items-center bg-light">
<nav class="d-flex flex-col justify-content-evenly">
    <ul class="list-inline mt-5 ml-5 pl-5">
       <li class="list-inline-item">
        <router-link :to="{name: 'eggweights'}" class="nav-link">
           <h5>Egg Delivery Weights</h5> 
        </router-link> 
    </li>
    <li class="list-inline-item ml-5">
        <router-link to="/feed-requests" class="nav-link">
            <h5>Feed Requests</h5>
        </router-link>
    </li>
    </ul>
</nav>
</div>
</div>
</div>
<div class="bg-light w-85 pt-2 h-100  mt-2 ">
    <div class="h-auto mt-4 pt-4 w-90 mx-5 mr-3 px-5 bg-white">
            <!-- table goes here -->
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">FARMER</th>
                        <th scope="col">COLLECTION CENTER/SCHEDULE</th>
                        <th scope="col">QUOTED DELIVERY</th>
                        <th scope="col">ACTUAL WEIGHT</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="text-primary font-weight-normal">
                            <router-link to="/confirm-request">Tumusiime Edward</router-link>
                        </th>
                            <td>Kampala Central on 11/Aug/22 
                                between 10:30AM & 11:30AM
                            </td>

                        <td>
                            45 Trays
                        </td>
                        <td>
                            201 Trays
                        </td>
                       
                        <td class="d-flex justify-content-center">
                        <button type="button" class="font-weight-bold">
                           <h5><i class="fas fa-pencil-alt"></i>
                            </h5>
                        </button>
                    </td>
                        <td class="ml-0">
                        <button type="button">
                            <h5>
                                <i class="fas fa-trash-alt"></i>
                                </h5>
                            </button>
                    </td>
                    </tr>
                </tbody>
            </table>
    </div>
</div>

</div>

            </div>

        <!-- end  -->
        </div>
  
  </template>
  
  <script>
  import SideNavigation from ".././Layout/enumeratorLayout/sideNavigation.vue";
  import menuList from ".././Layout/enumeratorLayout/menuList.vue";
  import Request from ".././mixins/requestHelper";
//   import AdminHeader from ".././Layout/adminLayout/header.vue";
  
  export default {
    name: "request-center",
    data() {
    return {
      user: {},
    };
  },
    components: { SideNavigation, menuList },
    
    mounted() {
    const app = this;
    app.user = Request.getUser();

    // app.getUser();
    // alert("Ok")
  },
  methods: {
    getUser() {
      //alert("Ok")
    },

    openOrCloseMenu() {
      $("#cp-nav-menu-enum").toggle();
    },
  },
  };
  </script>
  <style scope>
   nav a.active{
        border-bottom: 3px solid;
        color:slategrey;
     }
     h5{
        color:slategrey;
     }
  </style>