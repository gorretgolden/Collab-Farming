
<template>
  <div class="d-flex" v-cloak>
    <side-navigation />
    <div id="page-content-wrapper">
      <admin-header />

      <div class="content-padding">
        <div class="row">
          <div class="col-md-12">
            <div class="row mb-1">
              <div class="col-md-12" style="">
                <nav
                  class="nav nav-tab"
                  style="height: 55px; margin-bottom: -1rem"
                  id="unicef-tabs-cit"
                >
                  <a
                    @click.prevent="changeTab"
                    data-tab="0"
                    href="#"
                    style="color: #333; padding: 0.5rem 2.5rem !important"
                    class="nav-item nav-link active"
                    >Super Admins</a
                  >
                  <a
                    @click.prevent="changeTab"
                    data-tab="1"
                    href="#"
                    style="color: #333; padding: 0.5rem 2.5rem !important"
                    class="nav-item nav-link"
                    >Enumerators</a
                  >

                  <a
                    @click.prevent="changeTab"
                    data-tab="2"
                    href="#"
                    style="color: #333; padding: 0.5rem 2.5rem !important"
                    class="nav-item nav-link"
                    >Farmers</a
                  >
                  <a
                    @click.prevent="changeTab"
                    data-tab="3"
                    href="#"
                    style="color: #333; padding: 0.5rem 2.5rem !important"
                    class="nav-item nav-link"
                    >Collection Agents</a
                  >

                  <a
                    @click.prevent="changeTab"
                    data-tab="4"
                    href="#"
                    style="color: #333; padding: 0.5rem 2.5rem !important"
                    class="nav-item nav-link"
                    >Accounts</a
                  >
                </nav>
              </div>
            </div>

            <div class="cp-card">
              <div class="card-body" style="min-height: 70vh">
                <!--Super admin management-->
                <div
                  style="padding-left: 1rem; padding-right: 1rem"
                  v-if="tab == 0"
                >
                  <div
                    style="
                      display: flex;
                      margin-top: -10px;
                      margin-bottom: 10px;
                    "
                  >
                    <button
                      class="btn btn-primary"
                      style="
                        width: 180px;
                        margin-top: 1rem;
                        margin-bottom: 0.5rem;

                        margin-left: auto;
                      "
                      @click="addAccount(0, 'admin')"
                    >
                      Add Super Admin
                    </button>
                  </div>
                  <user-management
                    :heading="name"
                    :setEditData="(val) => setEditData(val)"
                    :getUsers="() => getUsers()"
                    :content="content"
                  />
                </div>

                <!--Super admin management-->
                <div
                  style="padding-left: 1rem; padding-right: 1rem"
                  v-if="tab == 1"
                >
                  <div
                    style="
                      display: flex;
                      margin-top: -10px;
                      margin-bottom: 10px;
                    "
                  >
                    <button
                      class="btn btn-primary"
                      style="
                        width: 180px;
                        margin-top: 1rem;
                        margin-bottom: 0.5rem;

                        margin-left: auto;
                      "
                      @click="addAccount(1, 'enum')"
                    >
                      Add Enumerator
                    </button>
                  </div>
                  <user-management
                    :heading="name"
                    :setEditData="(val) => setEditData(val)"
                    :getUsers="() => getUsers()"
                    :content="content"
                  />
                </div>

                <!--Super admin management-->
                <div
                  style="padding-left: 1rem; padding-right: 1rem"
                  v-if="tab == 2"
                >
                  <div
                    style="
                      display: flex;
                      margin-top: -10px;
                      margin-bottom: 10px;
                    "
                  >
                    <button
                      class="btn btn-primary"
                      style="
                        width: 180px;
                        margin-top: 1rem;
                        margin-bottom: 0.5rem;

                        margin-left: auto;
                      "
                      @click="addAccount(2, 'farm')"
                    >
                      Add Farmer
                    </button>
                  </div>
                  <user-management
                    :heading="name"
                    :getUsers="() => getUsers()"
                    :setEditData="(val) => setEditData(val)"
                    :content="content"
                  />
                </div>

                <!--Super admin management-->
                <div
                  style="padding-left: 1rem; padding-right: 1rem"
                  v-if="tab == 3"
                >
                  <div
                    style="
                      display: flex;
                      margin-top: -10px;
                      margin-bottom: 10px;
                    "
                  >
                    <button
                      class="btn btn-primary"
                      style="
                        width: 180px;
                        margin-top: 1rem;
                        margin-bottom: 0.5rem;

                        margin-left: auto;
                      "
                      @click="addAccount(3, 'agent')"
                    >
                      Add Collection Agent
                    </button>
                  </div>
                  <user-management
                    :heading="name"
                    :setEditData="(val) => setEditData(val)"
                    :getUsers="() => getUsers()"
                    :content="content"
                  />
                </div>
                <!--Super admin management-->
                <div
                  style="padding-left: 1rem; padding-right: 1rem"
                  v-if="tab == 4"
                >
                  <div
                    style="
                      display: flex;
                      margin-top: -10px;
                      margin-bottom: 10px;
                    "
                  >
                    <button
                      class="btn btn-primary"
                      style="
                        width: 180px;
                        margin-top: 1rem;
                        margin-bottom: 0.5rem;

                        margin-left: auto;
                      "
                      @click="addAccount(4, 'account')"
                    >
                      Add Accounts
                    </button>
                  </div>
                  <user-management
                    :getUsers="() => getUsers()"
                    :setEditData="(val) => setEditData(val)"
                    :heading="name"
                    :content="content"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <add-account
      :account_name="name"
      :id="id"
      :type="type"
      :addChange="add_change"
      :getUsers="() => getUsers()"
      :editData="editData"
    />
  </div>
</template>

<script>
import AdminHeader from "../../Layout/adminLayout/header.vue";
import sideNavigation from "../../Layout/adminLayout/sideNavigation.vue";
import AddAccount from "./addAccount.vue";
import UserManagement from "./userManagement.vue";

import Request from "../../mixins/requestHelper";
import Izitoast from "../../mixins/IziToast";

export default {
  components: { sideNavigation, AdminHeader, UserManagement, AddAccount },
  name: "users",
  mixins: [Izitoast],
  data() {
    return {
      tab: 0,
      content: [],
      name: "Super Admin",
      type: "admin",
      details: {},
      editData: {},
      add_change: "",
      id: "",
    };
  },
  mounted() {
    const app = this;

    //get users
    app.getUsers();
  },

  methods: {
    getAccountsrecord(t) {
      const app = this;
      if (t == 0) {
        app.name = "Super Admin";
        app.content = app.details.admin;
      }

      if (t == 1) {
        app.name = "Enumerators";
        app.content = app.details.enum;
      }

      if (t == 2) {
        app.name = "Farmers";
        app.content = app.details.farmer;
      }

      if (t == 3) {
        app.name = "Collection Agents";
        app.content = app.details.agent;
      }

      if (t == 4) {
        app.name = "Accounts";
        app.content = app.details.account;
      }
    },

    setEditData(c) {
      // alert("Ok")
      this.editData = c;
    },

    getUsers() {
      const app = this;
      Request.getMethod("/api/admin/get-users")
        .then((response) => {
          //console.log(response);
          //app.content = response.data.admin;
          app.details = response.data;

          //set the required records for the specific users
          app.getAccountsrecord(app.tab);

          //console.log(app.content);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },

    addAccount(c, type) {
      const app = this;
      app.type = type;
      app.add_change = type;

      //alert(app.add_change)
      $("#add-account-modal").modal("show");
    },

    changeTab(e) {
      let app = this;
      let element = $(e.target);
      var t = element.attr("data-tab");

      app.getAccountsrecord(t);
      app.tab = parseInt(t);
      element.addClass("active").siblings().removeClass("active");
    },
  },
};
</script>
