
<template>
  <table class="table table-sm unicef-activities-table">
    <thead>
      <tr>
        <th>{{ heading }}</th>
        <th style="">Created</th>

        <th style="margin-left: auto"></th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="(c, index) in content" :key="index + 'heading'">
        <td>{{ c.name }}</td>
        <td>{{ formatDate(c.created_at) }}</td>
        <td style="margin-left: auto">
          <a data-toggle="modal" data-target="#variableModal"
          
          @click="updateUser(c)"
          href="#">
            <i
              class="fas fa-pencil-alt"
              style="color: #999; font-size: 18px; cursor: pointer"
            >
            </i>
          </a>
          <a href="#" style="margin-left: 8px" @click="onDeleteUser(c.id)">
            <i
              class="far fa-trash-alt"
              style="color: #999; font-size: 18px"
            ></i>
          </a>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import IziToast from "../../mixins/IziToast";
import Request from "../../mixins/requestHelper";
import moment from "moment";


export default {
  name: "user-management",
  props: ["heading", "content", "getUsers", "setEditData"],
  
  mixins: [IziToast],

  methods: {

    updateUser(c){
      const app=this;

      $("#add-account-modal").modal("show");
      

      app.setEditData(c);

    },
    formatDate(date) {
            return moment(date).format("DD MMM YYYY");
        },
    onDeleteUser(id) {
      let app = this;

      Swal.fire({
        title: "Are you sure?",
        html: "<p style='font-size: 14px;'>You won't be able to revert this !</p>",
        icon: "warning",
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#40af40",
        confirmButtonText: "Delete",
      }).then((result) => {
        if (result.isConfirmed) {
          Request.getMethod(`/api/admin/delete-user/${id}`)
            .then((response) => {
              // alert("ok")
              app.showSuccessMessage("User deleted !");

             // window.location.reload(true);
             // alert("true");
              app.getUsers();
              //alert("ok")

      
          

          
            })
            .catch((error) => {});
        } else if (result.isDismissed) {
        }
      });
    },
  },
};
</script>
