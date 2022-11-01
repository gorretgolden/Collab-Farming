
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
        <td class="text-primary"
        style="cursor: pointer"
        @click="toggleViewProfile(c)"
        >{{ c.name }}</td>
        
        <td>{{ c.respondent_gender}}</td>
        <td>{{  c.district }}</td>
        <td>{{ c.created_at.substring(0,10)}}</td>
        <td style="margin-left: auto">
          <router-link :to="{ name: 'edit-farmer-profiling', params: { id: c.id}}">
          <a
            data-toggle="modal"
            data-target="#variableModal"
            href="#"
          >
            <i
              class="fas fa-pencil-alt"
              style="color: #999; font-size: 18px; cursor: pointer"
            >
            </i>
          </a>
        </router-link>
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
  <div
  class="modal fade"
  id="farmerProfileModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true"
  >
  <div class="modal-dialog modal-xl">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <div class="tabbable">
            <h1 style="text-align:center">{{ clickedProfile.name}}</h1>

            <ul class="nav nav-tabs">
              <li class="pull-right px-4"><a href="#tab1" data-toggle="tab">Address</a></li>
              <li class="active pull-right px-4"><a href="#tab2" data-toggle="tab">Household Information</a></li>
              <li class="active pull-right px-4"><a href="#tab3" data-toggle="tab">Social Information</a></li>
              <li class="active pull-right px-4"><a href="#tab4" data-toggle="tab">Egg Production</a></li>
              <li class="active pull-right px-4"><a href="#tab5" data-toggle="tab">Marketing</a></li>
              <li class="active pull-right px-4"><a href="#tab6" data-toggle="tab">Household Incomes</a></li>
              <li class="active pull-right px-4"><a href="#tab7" data-toggle="tab">Savings</a></li>

            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab1">
                <table class="table table-bordered">
                  <tr>
                  <th scope="col">Name of Egg Producer</th>
                  <td>{{ clickedProfile.name}} </td>
                  </tr>
                  <tr>
                  <th scope="col">Data Collection Date</th>
                  <td>{{ clickedProfile.email}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Name of Enumerator</th>
                  <td>{{ clickedProfile.data_collection_date}}</td>
                  </tr>
                  <tr>
                  <th scope="col">District</th>
                  <td>{{ clickedProfile.district}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Sub County</th>
                  <td>{{ clickedProfile.sub_county}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Parish</th>
                  <td>{{ clickedProfile.parish}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Village</th>
                  <td>{{ clickedProfile.village}}</td>
                  </tr>
                  
                </table>
              </div>
              <div class="tab-pane" id="tab2">
                <table class="table table-bordered">
                  <tr>
                  <th scope="col">Respondent Name</th>
                  <td>{{ clickedProfile.respondent_name}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Respondent's Gender</th>
                  <td>{{ clickedProfile.respondent_gender}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Respondent's DOB</th>
                  <td>{{ clickedProfile.respondent_dob}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Is Respondent Owner</th>
                  <td>{{ clickedProfile.is_respondent_owner}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Owner's DOB</th>
                  <td>{{ clickedProfile.dob_of_owner}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Owner's Gender</th>
                  <td>{{ clickedProfile.gender_of_owner}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Owner's Marital Status</th>
                  <td>{{ clickedProfile.marital_status_owner}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Owner's Level of Education</th>
                  <td>{{ clickedProfile.level_of_education_owner}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Owner's House Type</th>
                  <td>{{ clickedProfile.type_of_house_owner}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Owner's Roofing Type</th>
                  <td>{{ clickedProfile.type_of_roofing}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Owner's Religion</th>
                  <td>{{ clickedProfile.religion_of_owner}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Owner's Phone Number</th>
                  <td>{{ clickedProfile.registered_phone_owner}}</td>
                  </tr>
                  
                </table>
            </div>
            <div class="tab-pane" id="tab3">
              <table class="table table-bordered">
                  <tr>
                  <th scope="col">Belongs to Agricultural Group</th>
                  <td>{{ clickedProfile.belongs_to_agricultural_group}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Is Group for Poultry Farmers</th>
                  <td>{{ clickedProfile.is_group_for_poiltry_farmers}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Benefits of Group</th>
                  <td>{{ clickedProfile.benefits_of_group}}</td>
                  </tr>
                  <tr>
                  <th scope="col">If not in Group. Why?</th>
                  <td>{{ clickedProfile.why_not_in_group}}</td>
                  </tr>
               
                  
                </table>
            </div>
            <div class="tab-pane" id="tab4">
              <table class="table table-bordered">
                  <tr>
                  <th scope="col">Date Began Egg Production</th>
                  <td>{{ clickedProfile.when_started_egg_production}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Type of Birds</th>
                  <td>{{ clickedProfile.type_of_birds_kept}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Number of Egg Laying Birds</th>
                  <td>{{ clickedProfile.number_of_laying_birds}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Source of Feeds</th>
                  <td>{{ clickedProfile.main_source_of_feeds}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Source of Birds</th>
                  <td>{{ clickedProfile.source_of_birds}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Quality of Source of Birds</th>
                  <td>{{ clickedProfile.is_source_good}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Second Source of Birds</th>
                  <td>{{ clickedProfile.source_of_birds2}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Quality of Second Source of Birds</th>
                  <td>{{ clickedProfile.is_source_good2}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Third Source of Birds</th>
                  <td>{{ clickedProfile.source_of_birds3}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Quality of Third Source of Birds</th>
                  <td>{{ clickedProfile.is_source_good3}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Number of Annual Cycles</th>
                  <td>{{ clickedProfile.how_many_annual_cycles}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Type of records Kept at Farm</th>
                  <td>{{ clickedProfile.what_records_kept_at_farm}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Labor Provider</th>
                  <td>{{ clickedProfile.who_provides_labor}}</td>
                  </tr> 
                  <tr>
                  <th scope="col">Frequency of Labor Provider</th>
                  <td>{{ clickedProfile.frequency_of_labor}}</td>
                  </tr>
                   <tr>
                  <th scope="col">Second Labor Provider</th>
                  <td>{{ clickedProfile.who_provides_labor2}}</td>
                  </tr>
                   <tr>
                  <th scope="col">Frequency of Second Labor provider</th>
                  <td>{{ clickedProfile.frequency_of_labor2}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Third Labor Provider</th>
                  <td>{{ clickedProfile.who_provides_labor3}}</td>
                  </tr> 
                  <tr>
                  <th scope="col">Frequency of Third Labor Provider</th>
                  <td>{{ clickedProfile.frequency_of_labor3}}</td>
                  </tr> 
                  <tr>
                  <th scope="col">challenges</th>
                  <td>{{ clickedProfile.major_challenges}}</td>
                  </tr>
                   <tr>
                  <th scope="col">Solution</th>
                  <td>{{ clickedProfile.solution_to_challenge}}</td>
                  </tr>
                  
                </table>
            </div>
            <div class="tab-pane" id="tab5">
              <table class="table table-bordered">
                  <tr>
                  <th scope="col">Trays Collected Per Day</th>
                  <td>{{ clickedProfile.daily_trays_number}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Trays Collected per Week</th>
                  <td>{{ clickedProfile.weekly_trays_number}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Minimum Price of Eggs in Area</th>
                  <td>{{ clickedProfile.minimum_price_in_area}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Maximum Price of Eggs In Area</th>
                  <td>{{ clickedProfile.maximum_price_in_area}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Current Market</th>
                  <td>{{ clickedProfile.current_egg_market}}</td>
                  </tr>
                
                  
                </table>
            </div>
            <div class="tab-pane" id="tab6">
              <table class="table table-bordered">
                  <tr>
                  <th scope="col">Source of Income</th>
                  <td>{{ clickedProfile.Select_income_source}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Is Income Generating</th>
                  <td>{{ clickedProfile.do_you_get_money_from_source}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Who Gets it</th>
                  <td>{{ clickedProfile.who_gets_it}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Who Spends it</th>
                  <td>{{ clickedProfile.who_spents_it}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Second Source of Income</th>
                  <td>{{ clickedProfile.Select_income_source2}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Who gets Second Income</th>
                  <td>{{ clickedProfile.who_gets_it2}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Who Spends Second Source</th>
                  <td>{{ clickedProfile.who_spents_it2}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Third Source of Income</th>
                  <td>{{ clickedProfile.Select_income_source3}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Who gets Third Income</th>
                  <td>{{ clickedProfile.who_gets_it3}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Who Spends Third Source</th>
                  <td>{{ clickedProfile.who_spents_it3}}</td>
                  </tr>
                  
                </table>
            </div>
            <div class="tab-pane" id="tab7">
              <table class="table table-bordered">
                  <tr>
                  <th scope="col">Market Information</th>
                  <td>{{ clickedProfile.market_information}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Belongs to Saving Group</th>
                  <td>{{ clickedProfile.belongs_to_saving_group}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Saving Group Name</th>
                  <td>{{ clickedProfile.saving_group_name}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Saving Group Type</th>
                  <td>{{ clickedProfile.saving_group_type}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Second Saving Group Name</th>
                  <td>{{ clickedProfile.saving_group_name2}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Second Saving Group Type</th>
                  <td>{{ clickedProfile.saving_group_type2}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Third Saving Group Name</th>
                  <td>{{ clickedProfile.saving_group_name3}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Third Saving Group Type</th>
                  <td>{{ clickedProfile.saving_group_type3}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Consultation</th>
                  <td>{{ clickedProfile.consultation}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Consultation Number</th>
                  <td>{{ clickedProfile.consultation_number}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Information Requested</th>
                  <td>{{ clickedProfile.information_requested}}</td>
                  </tr>
                  <tr>
                  <th scope="col">Required Training</th>
                  <td>{{ clickedProfile.required_training}}</td>
                  </tr>
                  
                </table>
            </div>
            </div>
            
          </div>
        </div>
      </div>
  </div>


  </div>
</template>
  
  <script>
import IziToast from "../../mixins/IziToast";
import Request from "../../mixins/requestHelper";
import EditFarmerProfile from "../profiling/editFarmerProfile.vue";

export default {
  name: "user-management",
  components: {EditFarmerProfile},
  props: ["heading", "content", "getUsers", "setEditData", "profile"],
  mixins: [IziToast],

   data(){
      return{
        farmerinputs:[],
        clickedProfile: {},
    }
    },
  mounted(){
    let app = this;

  },
  methods: {
    
    updateUser(c) {
      const app = this;
      
      this.$router.push({
        path: `/edit-farmer-profiling/${c}`,
        replace: true,
      });
    },
    toggleViewProfile(item) {
          console.log(item);
          this.clickedProfile = item;
          $("#farmerProfileModal").modal("toggle");
      },
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
          axios.delete(`/api/delete-profile/${id}`);
          window.location.href='/enumerator-reports';

        } else if (result.isDismissed) {
        }
      });
    },
  },
};
</script>
  