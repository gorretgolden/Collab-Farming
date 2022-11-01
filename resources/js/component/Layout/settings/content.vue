<template>
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
      data-toggle="modal" data-target="#centersmodal">
        Add Bulking Center
    </button></span>
    </div>
<!-- Modal -->
<div class="modal fade" id="centersmodal" tabindex="-1" aria-labelledby="centersmodalLabel" aria-hidden="true">
  <div class="modal-dialog mx-auto">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title mx-auto" id="centersmodalLabel">Add New Center</h4>
   
      </div>
      <!-- centers form -->
      <div class="modal-body">
          <form method="POST">
      <div class="form-group">
            <label for="center-name" class="col-form-label">Name</label>
            <div class="input-group mb-2">
                <input type="text" name="name" class="form-control" v-model="name"/>    
            </div>
          <div class="form-group">
            <label for="addresslabel" class="col-form-label">Address</label>
            <div class="input-group mb-2">
                <input type="text" name="address" v-model="address" class="form-control" id="addresslabel"> 
                <span class="input-group-text input-group-append bg-black-50" >
               <i class="fas fa-map-marker-alt"></i>
                     </span>
            </div>
            <div class="form-group">
            <label for="collectingagent" class="col-form-label">Collection Agent</label>
            
              <div class="input-group ">
            <!-- <input type="text" class="form-control" id="collectingagent">-->   
            <select class="form-select form-control" 
            v-model="collectionagent" aria-label="agentscollect">
          <option disabled value="">Select </option>
         <option >Mundruku Ivan</option>
          
</select>
            <span class="input-group-text bg-black-50 border border-start-0" >
            <i class="fa fa-plus-square" aria-hidden="true"></i>
                     </span>
</div>
</div>
</div>
</div>
</form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn  font-weight-normal px-5 text-white mx-auto"
        @click.prevent="addcenter" data-dismiss="modal" >SAVE ME</button>
      </div>
</div>
  </div>
</div>
 </div>
 <!-- table -->
<div class="h-auto  pt-3 w-100 mx-5 px-5 bg-white">
            <table class="table table-hover">
            <!-- <caption> Bulking centers </caption> -->
            <thead class="thead-light">
            <tr>
                <th scope="col" class="text-black-50">BULKING CENTERS</th>
                   <th scope="col" ></th>
                <th scope="col" class="text-black-50">COLLECTION AGENT</th>
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
                <th scope="col"  ></th>
                <th scope="col"  ></th>
                
               <th scope="col" class="text-black-50">CREATED</th>
                <th scope="col" ></th>
</tr>
</thead>
<tbody >


<tr v-for="center in centers" :key="center.id">
    
    <td class="pt-3 text-primary fw-semibold">{{ center.address }} </td>
    <td></td>
    <td class="ps-4 pt-3 "> {{ center.collectionagent }}</td>
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
    <td class=" ps-4 pt-3">
     Last Month
    </td>
    
    <td>
    <span class="mx-3 h5 text-black-50">
    <button type="button"><i class="fas fa-pencil-alt"></i>
    </button>
    </span>
    <span class="mx-3 h5 text-black-50">
      <button type="button"><i class="fas fa-trash-alt"></i>
      </button>
      </span>
    </td>
    </tr>
</tbody>
        </table>
        </div>

 </div>
 </div>
 
<!-- </div> -->
</template>
<script>
import SideNavigation from "../.././Layout/adminLayout/sideNavigation.vue";
import menuList from "../.././Layout/adminLayout/menuList.vue";
import header from "../.././Layout/adminLayout/header.vue";
import Request from "../../mixins/requestHelper";
import { useCenters } from "../../mixins/fetchsettings";
// import { onMounted } from "vue";


export default{
    name:'centers-content',
    //props: ['bulkingcenters'],
    components: { SideNavigation, menuList },
    mounted(){
        const app = this;
         app.user=Request.getUser();
    },
    data:function(){
        return{
            // center:{
            //       name:"",
            //       address:"",
            //       collectionagent:""  
            // }
        }
    },
    methods:{
         addcenter(){
          let app = this;
                       
                       let formData = new FormData();
                                             
                       $.ajax({
                         url: "/api/store",
                       data: formData,
                       type: "POST",
                       processData: false,
                       contentType: false,
                       success: function(response){
                         
                       }
                   })
   
   


            // if (this.center.name ==''){
            //     return;
            // } else if(this.center.address == ''){
            //     return;
            // } else if(this.center.collectionagent == ''){
            //     return;
            // }
            // Request.postMethod('api/center/store', this.center )
            // .then(response => {
            //   console.log(response)
            //   if( response.status = 201){
            //         this.center.name = "";
            //         this.center.address = "";
            //         this.center.collectionagent = "";
            //     }
            // })
            // .catch(error => {
            //   console.log(error.response)
            //   //alert('i see the response');
            // })
            //return;
            // axios.post('api/center/store',{
            //     center: this.center
            // })
            // .then(response =>{
            //     if( response.status == 201){
            //         this.center.name = '';
            //         this.center.address = '';
            //         this.center.collectionagent = '';
            //         this.$toast.success('New center added successfully!');
            //     }
            // })
            // .catch( error => {
            //     console.log( error.response );
            //     this.$toast.error('Something went wrong!');
            // })
         }   
    },
    // setup(){
    //   const {centers, getCenters} = useCenters()

    //   // onMounted(getCenters)

    //   return{
    //     centers
    //   }
    // }
   
}
</script>
<style scope>

.btn{
    background-color:#a3360b;
}

</style>