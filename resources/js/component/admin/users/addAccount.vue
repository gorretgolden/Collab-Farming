<template>
  <div class="modal fade" id="add-account-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body p-5">
          <h5 class="text-center" style="font-size: 25px">
            Add {{ account_name }}
          </h5>
          <div style="display: flex; justify-content: center">
            <span>Whose account you wish to create</span>
          </div>
          <form id="account-form" class="mt-4">
            <!--
              <input hidden v-if="category.id" name="id" :value="category.id" />

              -->
            <div class="form-group">
              <label> Names </label>
              <input
                class="form-control py-3 px-3 cp-text-l"
                name="name"
                placeholder="Full Name"
                type="text"
                v-model="name"
                required
              />

              <input hidden name="id" :value="id" />
            </div>
            <div class="form-group">
              <label> Email </label>
              <input
                class="form-control py-3 px-3 cp-text-l"
                name="email"
                placeholder="Email"
                type="email"
                v-model="email"
                required
              />
            </div>
          </form>
          <div class="w-100 d-flex justify-content-center text-center mt-4">
            <button
              type="button"
              class="cp-btn cp-btn-g-primary px-6"
              @click.prevent="saveUser"
            >
              <span>
                <i v-if="isLoading" class="fa fa-spinner fa-spin"> </i>

                SAVE
              </span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import Request from "../../mixins/requestHelper";
import IziToast from "../../mixins/IziToast";
export default {
  name: "add-account",

  props: ["id", "account_name", "type", "getUsers", "addChange", "editData"],

  mixins: [IziToast],
  data() {
    return {
      name: "",
      email: "",
      id: "",
      isLoading: false,
    };
  },

  watch: {
    editData: function (newVal) {
      const app = this;

      if (newVal) {
        app.name = newVal.name;
        app.email = newVal.email;
        app.id = newVal.id;
      }
    },
    addChange: function (newVal) {
      const app = this;
      // alert("Ok")
      if (newVal) {
        app.name = "";
        app.email = "";
        app.id = "";
      }
    },
  },
  methods: {
    saveUser() {
      const app = this;
      let form = $("#account-form");
      if (form.valid()) {
        app.isLoading = true;
        const formData = {
          email: app.email,
          name: app.name,
          id: app.id,
          type: app.type,
        };

        Request.postMethod("/api/admin/create-account", formData)
          .then((response) => {
            app.isLoading = false;
            app.showSuccessMessage("Account Successfully added");

            //  window.location.reload(true);
            // alert("Ok")
            app.getUsers();

            $("#add-account-modal").modal("hide");
            // console.log(response);
          })
          .catch((error) => {
            app.isLoading = false;
            //console.log(error.response);
            if (error.response.status == 405) {
              app.showErrorMessage(error.response.data);
              return;
            }

            app.showErrorMessage("Somehting Went Wrong, try again latter");
          });
      }
    },
  },
};
</script>
