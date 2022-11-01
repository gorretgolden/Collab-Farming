<template>
    <div class="CContainer fluid d-flex" v-cloak>
    <side-navigation />
<!-- centers, prices, inputs -->
 <div class="w-100 bg-light ">
    <div class="row">
      <div class="col-md-12 ">
       <div class="h-100 w-100 mr-4">
<div class="bg-white p-4 px-4 text-black-50 h-100 d-flex flex-row-reverse vw-85 align-items-center">
        <span class="h4 mt-3 mr-5"><i class="fa fa-align-justify"></i></span>
                <p class="pt-3 h6 mr-4 text-black-50">Welcome Admin</p>
        </div>
</div>
      </div>
  <div class="bg-light w-100 pt-2  h-100">
<div class="h-15 vw-90 d-flex flex-row align-items-center bg-headshade"> 
 <router-link  to="/centers">        
<div class="ml-5 pt-2">      
   
         <button type="button" class="pt-2 "> 
                  <p class="h5 ml-5 ">Bulking Centers</p>
</button>
</div>
</router-link>
<router-link  to="/newprices">
<div class="ml-5 pt-2">
<button type="button" class="pt-2 bg-black-50" > 
                <p class="h5 ml-5">Egg Prices</p>
</button>
</div>
</router-link>
<router-link  to="/farmer-inputs">
<div class="ml-5 pt-2">
<button type="button" class="pt-2" > 
                <p class="h5 ml-5">Inputs</p>
</button>
</div>
</router-link>
    </div>
    </div>
     <!-- bulking center button -->
 <div class="w-100 mx-5 px-5 h-100 pt-3 bg-white">
<div class="h-10 d-flex flex-row-reverse  align-items-end w-100">

    <span class="mb-2"><button class="px-4 font-weight-normal text-white btn-sm bg-primary"
      data-toggle="modal" data-target="#inputsmodal">
        Add New Input
    </button></span>
    </div>
    <!-- Modal -->
<div class="modal fade" id="inputsmodal" tabindex="-1" aria-labelledby="inputsmodalLabel" aria-hidden="true">
  <div class="modal-dialog mx-auto">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title mx-auto" id="inputsmodalLabel">Add New Input</h4>
   
      </div>
      <!-- centers form -->
      <div class="modal-body">
          <form id="input-form">
      <div class="form-group">
            <label for="inputs" class="col-form-label">Input</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" v-model="inputs" />    
            </div>
     

</div>
</form>
      </div>
      <div class="modal-footer">
        <button class="btn  font-weight-normal px-5 text-white mx-auto"
        @click.prevent="store()" data-dismiss="modal">SAVE</button>
      </div>
</div>
  </div>
</div>
 </div>
 <inputs-management/>


 <div class="">
            <table class="table">
            
            <thead class="">
            <tr>
                <th scope="col" class="">AVAILABLE INPUTS</th>
                   <th scope="col" ></th>
                <th scope="col" class=""></th>
                <th scope="col" ></th>
                <th scope="col" ></th>
                <th scope="col" ></th>
                <th scope="col" ></th>
                <th scope="col" ></th>
                <th scope="col" ></th>
                <th scope="col" ></th>
                <th scope="col" ></th>
                <th scope="col" ></th>
                <th scope="col" ></th>
                <th scope="col" ></th>
                <th scope="col" ></th>
                <th scope="col" ></th>
                <th scope="col" ></th>
                 <th scope="col"></th>
                <th scope="col"></th>
                 <th scope="col"></th>
               <th scope="col" class="text-black-50">CREATED</th>
                <th scope="col" ></th>
</tr>
</thead>
<tbody >
<tr v-for="(farmerinput, index) in farmerinputs" :key="index">
    <td class="pt-3 ">{{ farmerinput.inputs}}hhhhhh</td>
    <td></td>
    <td class=" pt-3 "></td>
              <td>nnnn</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
    <td class=""> </td>
    <td class="h6 text-black">
  
    </td>
    <td class="h6 text-black">
  
    </td>
   <td class="h6 text-black">
  
    </td>
    
     <td class="h6 text-black">
  {{ farmerinput.inputCreated}}
    </td>
    
    
    <td>
    <span class="mx-3 h5 text-black-50">
    <button type="button"><i class="fas fa-pencil-alt">
    </i></button>
    </span>
    <span class="mx-3 h5 text-black-50">
     <button type="button"> <i class="fas fa-trash-alt"></i>
     </button>
      </span>
    </td>
   
    
</tr>
</tbody>
        </table>
        </div>

</div>

</div>
</div>
</template>

<script>
import SideNavigation from "../../Layout/adminLayout/sideNavigation.vue";
import inputsManagement from "../../admin/settings/inputsManagement.vue";
import InputsManagement from "./inputsManagement.vue";

export default{
    name:"inputs-dashboard",
    components: { SideNavigation, inputsManagement, InputsManagement },
 
    data(){
      return{
        farmerinputs:[],
    }
    },
    mounted(){
    const app = this;
    app.getInputsList();
    },

    methods:{
      getInputsList() {
            let app = this;
            Request.getMethod("/api/input-list")
                .then((result) => {
                 console.log(result.data);
                 app.farmerinputs = result.data;
           
                })
                .catch((error) => {
                    console.log(error);
                });
        },
 
      store(){
            let app = this;
            let form = $("#input-form");
            if (form) {
                let formData = new FormData();
                formData.append('inputs', app.inputs);

                $.ajax({
                        url: `/api/store-input`,
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success(data) {
                            Swal.fire({
                            title: "Saved",
                            icon: "success",
                            html: '<p style="font-size: 14px">The record has successfully been saved.</p>',
                            showCloseButton: false,
                            showCancelButton: false,
                            focusConfirm: true,
                            confirmButtonText: "OK",
                            confirmButtonColor: "#43ad60",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            closeOnClickOutside: false,
                            
                            })
                            

                            $("#pricemodal").modal("hide");
                            this.getLatestPrice();


                        },
            });  

        }
       
        
    },
      
    }
} 
    

</script>