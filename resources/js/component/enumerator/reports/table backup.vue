
<template>
    <table class="table table-sm unicef-activities-table">
      <thead>
        <tr>
          <th>Egg Producer</th>
          <th style="">Gender</th>
          <th>District</th>
  
          <th>Profiled</th>
          <th style="margin-left: auto"></th>
        </tr>
      </thead>
  
      <tbody>
        <tr v-for="(c, index) in content" :key="index + 'heading'">
          <td>{{ retriveProperty(c.address, "names") }}</td>
  
          <td>{{ retriveProperty(c.address, "names") }}</td>
          <td>{{ retriveProperty(c.address, "district") }}</td>
          <td>{{ c.created_at }}</td>
          <td style="margin-left: auto">
            <a
              data-toggle="modal"
              data-target="#variableModal"
              @click="updateUser(c.id)"
              href="#"
            >
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
  
  export default {
    name: "user-management",
    props: ["heading", "content", "getUsers", "setEditData"],
    mixins: [IziToast],
  
    methods: {
      updateUser(c) {
        const app = this;
  
        this.$router.push({
          path: `/egg-producer-profiling/${c}`,
          replace: true,
        });
      },
  
      retriveProperty(data, property) {
        const dataItem = JSON.parse(data);
  
        return dataItem[property];
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
    