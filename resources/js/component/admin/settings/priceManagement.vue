<template>
      <table class="table table-sm unicef-activities-table">
    <thead>
      <tr>
        <th>PRICE/KG (UGX)</th>
        <th style="">CREATED</th>

        <th style="margin-left: auto"></th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="(price, index) in prices" :key="index">
        <td>{{ price.newprice }}</td>
        <td>{{ price.priceCreated.substring(0,10)   }}</td>
        <td style="margin-left: auto">
          
        </td>
      </tr>
    </tbody>
  </table>
   
</template>
<script>
import Request from "./../../mixins/requestHelper";

export default {
    name: 'price-management',
    data:function(){
        return {
            prices:[]
        }
    },
mounted(){
    const app = this;
    app.getLatestPrice();

},
methods:{
    deleteInput(id){
        const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-2'
                  },
                  buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                  title: 'Confirm Deletion',
                  html: " <small>You are about to delete this input. Proceed ?</small>",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, Proceed!',
                  cancelButtonText: 'No, cancel!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.isConfirmed) {
                      Vue.nextTick(function () {
                        axios.delete(`/api/delete-price/${id}`)
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
                      })
                  } 
                })

                            this.getLatestPrice();

  },
 
            getLatestPrice() {
            let app = this;
            Request.getMethod("/api/price-list")
                .then((result) => {
                 console.log(result.data);
                 app.prices = result.data;
                   
            
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        },

 
        
    }


</script>