 
 <template>
    <table class="table table-sm unicef-activities-table">
    <thead>
      <tr>
        <th>BULKING CENTERS</th>
        <th style="">COLLECTION AGENT</th>

        <th style="margin-left: auto">CREATED</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="(center, index) in centers" :key="index">
        <td>{{ center.name }}</td>
        <td>{{ center.collectionagent }}</td>
        <td>{{ center.centerCreated.substring(0,10) }}</td>
        <td>
            <span class="mx-3 h5 text-black-50">
              <button 
              @click.prevent="showupdatecenter(center)"
              type="button"><i class="fas fa-pencil-alt" style="margin-left: 8px"></i></button>
            </span>
              <!-- Modal -->
              <div
              class="modal fade"
              id="editcentersmodal"
              tabindex="-1"
              aria-labelledby="editcentersmodalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog mx-auto">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title mx-auto" id="editcentersmodalLabel">
                      Edit Center
                    </h4>
                  </div>
                  <!-- centers form -->
                  <div class="modal-body">
                    <form id="edit-center-form" class="mt-4">
            <!--
              <input hidden v-if="category.id" name="id" :value="category.id" />

              -->
            <div class="form-group">
              <label> Name </label>
              <input
                class="form-control py-3 px-3 cp-text-l"
                v-model="name"
                type="text"
                :placeholder="selectedCenter.name"
                required
              />

              <input hidden name="id" :value="id" />
            </div>
            <div class="form-group">
              <label> Address </label>
              <input
                class="form-control py-3 px-3 cp-text-l"
                v-model="address"
                type="address"
                :placeholder="selectedCenter.address"
                required
              />
            </div>
            <div class="form-group">
              <label> collection Agent </label>
            </div>
            <select class="form-select form-control" 
            v-model="collectionagent"
            aria-label="agentscollect">
          <option selected value="">{{selectedCenter.collectionagent}}</option>
          <option 
          v-for="(x, index) in details" :key="index"
          :value="x.user.name">{{x.user.name}}</option>
          
</select>
          </form>
          <div class="w-100 d-flex justify-content-center text-center mt-4">
            <button
              type="button"
              class="cp-btn cp-btn-g-primary px-6"
              style="color: #999; font-size: 18px; cursor: pointer"
              @click.prevent="updatecenter(center.id)"
            >
              <span>
                <i v-if="isLoading" class="fa fa-spinner fa-spin"> </i>

                SAVE CENTER
              </span>
            </button>                  </div>
                </div>
              </div>
            </div>
          </div>

            <span class="mx-3 h5 text-black-50">
              <button type="button" @click.prevent="deleteInput(center.id)"><i class="fas fa-trash-alt"></i></button>
            </span>
          </td>
      </tr>
    </tbody>
  </table>
  <!-- table -->
 
</template>
 <script>
import axios from 'axios';
import Request from "../../mixins/requestHelper";

export default {
  name: "center-management",
  data() {
    return {
      centers: [],
      name: "",
        address: "",
        collectionagent: "", 
        isLoading: false,
        details: {},
        selectedCenter: {},
    };
  },
  mounted(){
   let app = this;
   app.getCenter();
   app.getUsers();

  },
  methods: {
    showupdatecenter(item){
      let app = this;
      app.selectedCenter  = item;
      $("#editcentersmodal").modal("show");
    },
    updatecenter(id) {
      const app = this;
      let form = $("#edit-center-form");
      if (form) {
        let formData = new FormData();
        formData.append('address', app.address); 
        formData.append('name', app.name); 
        formData.append('collectionagent', app.collectionagent); 
        formData.append('id', this.selectedCenter.id);


        $.ajax({
                        url: `/api/update-center/${id}`,
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success(data) {
                            Swal.fire({
                            title: "Saved",
                            icon: "success",
                            html: '<p style="font-size: 14px">The center has successfully been updated.</p>',
                            showCloseButton: false,
                            showCancelButton: false,
                            focusConfirm: true,
                            confirmButtonText: "OK",
                            confirmButtonColor: "#43ad60",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            closeOnClickOutside: false,
                            
                            })
                            
                            app.getCenter();
                            $("#editcentersmodal").modal("hide");



                        },
            });               
  
      }
    },
    deleteInput(id){
    
    Swal.fire({
                            title: "Deleted",
                            icon: "success",
                            html: '<p style="font-size: 14px">The record has successfully been deleted.</p>',
                            showCloseButton: false,
                            showCancelButton: false,
                            focusConfirm: true,
                            confirmButtonText: "OK",
                            confirmButtonColor: "#43ad60",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            closeOnClickOutside: false,
                            
                            })
                            
        
                            const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-2'
                  },
                  buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                  title: 'Confirm Deletion',
                  html: " <small>You are about to delete this center. Proceed ?</small>",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, Proceed!',
                  cancelButtonText: 'No, cancel!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.isConfirmed) {

                    axios.delete(`/api/delete-center/${id}`)
                    this.getCenter();

                        Swal.fire({
                            title: "Deleted",
                            icon: "success",
                            html: '<p style="font-size: 14px">The record has successfully been deleted.</p>',
                            showCloseButton: false,
                            showCancelButton: false,
                            focusConfirm: true,
                            confirmButtonText: "OK",
                            confirmButtonColor: "#43ad60",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            closeOnClickOutside: false,
                            
                            })
                      
                    }
                  })

  },
  getUsers() {
      const app = this;
      Request.getMethod("/api/admin/get-collectors")
        .then((response) => {
          //console.log(response);
          //app.content = response.data.admin;
          app.details = response.data;

          //set the required records for the specific users

          //console.log(app.content);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    getCenter() {
      //Consider re using the helper  function for making api  calls

      Request.getMethod("/api/admin/centers")
        .then((response) => {
          this.centers = response.data;
        })
        .catch((error) => {
          console.log(error.response);
        });

      /*

      axios
        .get("api/centers")
        .then((response) => {
          this.centers = response.data;

          console.log(this.center);
        })
        .catch((error) => {
          console.log(error.response);
        });
        */
    },
  },
  created() {
    this.getCenter();
  },
};
</script>