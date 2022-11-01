<template>
    <div class="CContainer fluid d-flex" v-cloak>
      <div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading d-flex justify-content-center">
      <router-link to="/" class="d-contents">
        <!-- <img
          src="images/icon/logo.png"
       
        /> -->
      </router-link>
    </div>
    <div class="list-group list-group-flush mt-2">
      <router-link class="list-group-item" to="/fanmis-enumerator">
        <div class="row">
          <div class="col-sm-1">
            <i class="fas fa-home" style="color:goldenrod !important;"></i>
          </div>
          <div class="col-sm-9">
            <span>Home</span>
          </div>
        </div>
      </router-link>
      <router-link class="list-group-item" to="/enumerator-reports">
        <div class="row">
          <div class="col-sm-1">
            <i class="fas fa-user-friends" style="color:goldenrod !important;"></i>
          </div>
          <div class="col-sm-9">
            <span>Reports</span>
          </div>
        </div>
      </router-link>
   
    </div>
  </div>
  <div class="w-100 bg-light ">
  <nav
    class="navbar navbar-expand-lg border-bottom shadow-sm"
    style="background: white;height: 5%;"
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
  <div
    class="bs-stepper-header mb-2"
    style="justify-content: center; width: 100%"
  >
    <div class="progress-container">
      <div class="step" :data-target="`#step1-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 1 }"
          
        >
          <span class="bs-stepper-circle" v-if="step >= 1"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else> 1 </span>
          <br />
          <span class="label_member_add">Address</span>
        </button>
      </div>

      <div
        class="line_cooperative_ivan"
        :class="`active ${step >= 2 ? 'line-active' : ''}`"
        style="width: 4rem"
      ></div>

      <div class="step" :data-target="`#step2-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 2 }"
        >
          <span class="bs-stepper-circle" v-if="step >= 2"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else>2</span>
          <br />
          <span class="label_member_add">Household Information</span>
        </button>
      </div>
      <div
        class="line_cooperative_ivan"
        :class="`active ${step >= 3 ? 'line-active' : ''}`"
        style="width: 4rem"
      ></div>

      <div class="step" :data-target="`#step2-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 3 }"
        >
          <span class="bs-stepper-circle" v-if="step >= 3"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else>3</span>
          <br />
          <span class="label_member_add">Social Information</span>
        </button>
      </div>
      <div
        class="line_cooperative_ivan"
        :class="`active ${step >= 4 ? 'line-active' : ''}`"
        style="width: 4rem"
      ></div>

      <div class="step" :data-target="`#step2-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 4 }"
        >
          <span class="bs-stepper-circle" v-if="step >= 4"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else>4</span>
          <br />
          <span class="label_member_add">Egg Production</span>
        </button>
      </div>
      <div
        class="line_cooperative_ivan"
        :class="`active ${step >= 5 ? 'line-active' : ''}`"
        style="width: 4rem"
      ></div>

      <div class="step" :data-target="`#step2-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 5 }"
        >
          <span class="bs-stepper-circle" v-if="step >= 5"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else>5</span>
          <br />
          <span class="label_member_add">Marketing</span>
        </button>
      </div>
      <div
        class="line_cooperative_ivan"
        :class="`active ${step >= 6 ? 'line-active' : ''}`"
        style="width: 4rem"
      ></div>

      <div class="step" :data-target="`#step2-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 6 }"
        >
          <span class="bs-stepper-circle" v-if="step >= 6"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else>6</span>
          <br />
          <span class="label_member_add">Household Income</span>
        </button>
      </div>
      <div
        class="line_cooperative_ivan"
        :class="`active ${step >= 7 ? 'line-active' : ''}`"
        style="width: 4rem"
      ></div>

      <div class="step" :data-target="`#step2-view`">
        <button
          type="button"
          class="step-trigger"
          :class="{ active: step >= 7 }"
        >
          <span class="bs-stepper-circle" v-if="step >= 7"
            ><i class="fa fa-check"></i
          ></span>
          <span class="bs-stepper-circle" v-else>7</span>
          <br />
          <span class="label_member_add">Savings</span>
        </button>
      </div>
    </div>
  </div>
        <!-- <enum-header /> -->
        <div class="content-padding">
          <!-- <progress-indicator :step="step" /> -->
         

         <form
             id="collect-data"
             @submit.prevent=""
             class="needs-validation content-padding"
             
             novalidate
            
         >
            <div v-if="step == 1">
                        <div class="cp-card">
                        <div class="content">
                            <div class="">
                            <div class="card-body">
                                <div class="row">
                                <div class="col">
                                    <p class="h2" style="font-weight: 380">Egg Producer Bio Data</p>
                                    <hr />

                                    <div class="form-group">
                                    <label for="names">Names</label>
                                    <input
                                        type="text"
                                        class="form-control col-6"
                                        v-model="names"
                                        id="names"
                                        aria-describedby="UserName"
                                        placeholder="Names"
                                        required
                                    />
                                    </div>

                                    <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input
                                        type="email"
                                        v-model="email"
                                        class="form-control col-6"
                                        id="email"
                                        aria-describedby="UserName"
                                        placeholder="Email Address"
                                        required
                                    />
                                    </div>

                                    <div class="form-group">
                                    <label for="date">Data Collection Date</label>
                                    <input
                                        type="date"
                                        class="form-control col-6"
                                        v-model="collection_date"
                                        id="date"
                                        aria-describedby="Date"
                                        placeholder="date"
                                        required
                                    />
                                    </div>

                                    <p class="h2" style="font-weight: 380; margin-top: 2rem">
                                    Geographic Information Address
                                    </p>
                                    <hr />

                                    <div class="form-group">
                                    <label for="address">1. Address</label>

                                    <div style="width: 50%; margin-bottom: -1rem">
                                        <map-view
                                        inputId="address"
                                        :onSetEvent="(val) => onSetEvent(val)"
                                        :required="true"
                                        :value="address"
                                    
                                        />
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label for="District">2.District</label>
                                    <select
                                        v-model="district"
                                        @change="(e) => getSubCounty(e)"
                                        class="form-control col-6"
                                        id="District"
                                        required
                                    >
                                        <option value="">Select</option>
                                        <option
                                        v-for="(c, index) in districts"
                                        :key="index + 'static_districts'"
                                        :value="c.DistrictName"
                                        >
                                        {{ c.DistrictName }}
                                        </option>
                                    </select>
                                    </div>

                                    <div class="form-group">
                                    <label for="Subcounty">3.Sub County</label>
                                    <select
                                        v-model="sub_county"
                                        @change="(e) => getParish(e)"
                                        class="form-control col-6"
                                        id="Subcounty"
                                        required
                                    >
                                        <option value="">Select</option>
                                        <option
                                        :value="c.SubCountyName"
                                        v-for="(c, index) in subCountyData"
                                        :key="index + 'sub_county'"
                                        >
                                        {{ c.SubCountyName }}
                                        </option>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                    <label for="Parish">4. Parish</label>
                                    <select
                                        required 
                                        v-model="parish"
                                        class="form-control col-6"
                                        @change="(e) => getVillage(e)"
                                        id="Parish"
                                    >
                                        <option value="">Select</option>
                                        <option
                                        :value="c.ParishName"
                                        v-for="(c, index) in parishes"
                                        :key="index + 'parish'"
                                        >
                                        {{ c.ParishName }}
                                        </option>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                    <label for="Village">5. Village</label>
                                    <select
                                        v-model="village"
                                        class="form-control col-6"
                                        id="Village"
                                        required
                                    >
                                        <option value="">Select</option>
                                        <option
                                        :value="c.VillageName"
                                        v-for="(c, index) in villages"
                                        :key="index + 'village'"
                                        >
                                        {{ c.VillageName }}
                                        </option>
                                    </select>
                                    </div>

                                    <div
                                    class="text-center mx-auto"
                                    style="display: flex; justify-content: center; padding: 2rem"
                                    >
                                    <button
                                        :disabled="isLoading"
                                        class="submit_event cp-btn"
                                        style="padding: 1rem 5rem; background-color: #004e89"
                                    >
                                        <span
                                        ><i v-if="isLoadingExit" class="fa fa-spinner fa-spin"></i
                                        ></span>
                                        SAVE & EXIT
                                    </button>

                                    <button
                                        :disabled="isLoading"
                                        class="cp-btn cp-btn-g-primary"
                                        style="padding: 1rem 5rem; margin-left: 1rem"
                                        id="submit_event_proceed"
                                        type="btn"
                                        @click="clickEventTriggerAddress()"
                                    >
                                        <span
                                        ><i v-if="isLoading" class="fa fa-spinner fa-spin"></i
                                        ></span>
                                        SAVE & PROCEED
                                    </button>
                                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    
                </div>
            
        <div v-if="step == 2">
                <div class="cp-card" style="margin: 1rem 0rem 0 2rem; padding: 1rem">
        <div id="step0-view" class="content">
            <div class="">
            <div class="card-body">
                <div class="row">
                <div class="col">
                    <p class="h2" style="font-weight: 380">
                    Respondent and general household information
                    </p>
                    <hr />

                    <div class="form-group">
                    <label for="respondent">6. Name of Respondent</label>
                    <input
                        type="text"
                        class="form-control col-6"
                        id="respondent"
                        aria-describedby="UserName"
                        v-model="respondent_name"
                        placeholder="Names"
                        required
                    />
                    </div>

                    <div class="form-group">
                    <label for="email">7. Respondent's Gender</label>
                    <div class="form-check mt-2">
                        <input
                        class="form-check-input"
                        type="radio"
                        name="gender"
                        id="genderMale"
                        v-model="respondents_gender"
                        value="Male"
                        required
                        />
                        <label class="form-check-label" for="genderMale">
                        Male
                        </label>
                    </div>

                    <div class="form-check mt-2">
                        <input
                        class="form-check-input"
                        type="radio"
                        name="gender"
                        id="genderFemale"
                        v-model="respondents_gender"
                        value="Female"
                        required
                        />
                        <label class="form-check-label" for="genderFemale">
                        Female
                        </label>
                    </div>
                    </div>

                    <div class="form-group">
                    <label for="date">8. Respondent's Date of Birth</label>
                    <input
                        type="date"
                        class="form-control col-6"
                        id="date"
                        aria-describedby="Date"
                        v-model="respondents_date_of_birth"
                        placeholder="date"
                        required
                    />
                    </div>

                    <div class="form-group">
                    <label for="email"
                        >9. Is Respondent Owner of the enterprise?</label
                    >
                    <div class="form-check mt-2">
                        <input
                        class="form-check-input"
                        type="radio"
                        name="owenr_of_enterprise"
                        id="owenr_of_enterprise-yes"
                        :value="1"
                        required
                        v-model="is_respondent_owner_of_enterprise"
                        />
                        <label
                        class="form-check-label"
                        for="owenr_of_enterprise-yes"
                        >
                        Yes
                        </label>
                    </div>

                    <div class="form-check mt-2">
                        <input
                        class="form-check-input"
                        type="radio"
                        name="owenr_of_enterprise"
                        id="owenr_of_enterprise-no"
                        v-model="is_respondent_owner_of_enterprise"
                        :value="0"
                        required
                        />
                        <label
                        class="form-check-label"
                        for="owenr_of_enterprise-no"
                        >
                        No
                        </label>
                    </div>
                    </div>

                    <div
                    class="form-group"
                    v-if="is_respondent_owner_of_enterprise == 0"
                    >
                    <label for="Subcounty"
                        >10. If No, state the relationship to owner of the
                        enterprise</label
                    >
                    <select
                        class="form-control col-6"
                        id="Subcounty"
                        v-model="relationship_to_owner"
                        required
                    >
                        <option value="">Select</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Son/Daughter">Son/Daughter</option>
                        <option value="Father/Mother">Father/Mother</option>
                        <option value="Son/Daughter in law">
                        Son/Daughter in law
                        </option>
                        <option value="Grandchild">Grandchild</option>
                        <option value="Other Relative">Other Relative</option>
                        <option value="">Hired Worker</option>
                        <option value="Hired Worker">Other Specify</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="date-owner"
                        >11. Date of Birth of the owner of the enterprise
                    </label>
                    <input
                        type="date"
                        required
                        class="form-control col-6"
                        v-model="enterprise_owner_date_of_birth"
                        id="date-owner"
                        aria-describedby="Date"
                        placeholder="date"
                    />
                    </div>

                    <div class="form-group">
                    <label for="gender-owenr"
                        >12. Gender of enterprise owner</label
                    >
                    <div class="form-check mt-2">
                        <input
                        class="form-check-input"
                        required
                        type="radio"
                        name="enterprise_owner_gender"
                        id="enterprise_owner_gender-male"
                        v-model="enterprise_owner_gender"
                        value="Male"
                        />
                        <label
                        class="form-check-label"
                        for="enterprise_owner_gender-male"
                        >
                        Male
                        </label>
                    </div>

                    <div class="form-check mt-2">
                        <input
                        class="form-check-input"
                        type="radio"
                        required
                        name="enterprise_owner_gender"
                        id="enterprise_owner_gender-female"
                        value="Female"
                        v-model="enterprise_owner_gender"
                        />
                        <label
                        class="form-check-label"
                        for="enterprise_owner_gender-female"
                        >
                        Female
                        </label>
                    </div>
                    </div>

                    <div class="form-group">
                    <label for="marital"
                        >13. Marital Status of the enterprise owner</label
                    >
                    <select
                        v-model="enterprise_owner_marital_status"
                        class="form-control col-6"
                        id="marital"
                        required
                    >
                        <option value="">Select</option>

                        <option value="Married but spouse away">
                        Married but spouse away
                        </option>
                        <option value=">Married living with spouse">
                        Married living with spouse
                        </option>

                        <option value="Separted/Dirvorced">
                        Separted/Dirvorced
                        </option>

                        <option value="Widow/Widower">Widow/Widower</option>
                        <option value="Not Married">Not Married</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="level-education"
                        >14. Level of Education of the enterprise owner
                    </label>
                    <select
                        v-model="enterprise_owner_education_level"
                        required
                        class="form-control col-6"
                        id="level-education"
                    >
                        <option value="">Select</option>
                        <option value="No formal Education">
                        No formal Education
                        </option>
                        <option value="Primary">Primary</option>
                        <option value="O Level">O Level</option>
                        <option value="A Level">A Level</option>
                        <option value="University or tertiary (diploma, degree)">
                        University or tertiary (diploma, degree)
                        </option>
                        <option value="Post graduate (Masters / PHD)">
                        Post graduate (Masters / PHD)
                        </option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="house-type"
                        >15. Type of house for the enterprise owner</label
                    >
                    <select
                        v-model="enterprise_owner_house_type"
                        required
                        class="form-control col-6"
                        id="house-type"
                    >
                        <option value="">Select</option>
                        <option value="Permanent">Permanent</option>
                        <option value="Semi Permanent">Semi Permanent</option>
                        <option value="Temporarily">Temporarily</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="roof-type">16. Type of roofing</label>
                    <select
                        v-model="enterprise_owner_roofing_type"
                        required
                        class="form-control col-6"
                        id="roof-type"
                    >
                        <option value="">Select</option>
                        <option value="Straw/Thatch">Straw/Thatch</option>
                        <option value="wood/planks">wood/planks</option>
                        <option value="tiles">tiles</option>

                        <option value="iron sheets">iron sheets</option>
                        <option value="asbestos">asbestos</option>
                        <option value="tin">tin</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="house-type"
                        >17. Religion of the enterprise owner</label
                    >
                    <select
                        class="form-control col-6"
                        id="house-type"
                        v-model="enterprise_owner_religion"
                        required
                    >
                        <option value="">Select</option>
                        <option value="No religion/atheist">
                        No religion/atheist
                        </option>
                        <option value="Orthodox Christian">
                        Orthodox Christian
                        </option>
                        <option value="Catholic">Catholic</option>
                        <option value="Protestant">Protestant</option>

                        <option value="Catholic">Other Christian</option>
                        <option value="Protestant">Muslim</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="phone"
                        >18. Registered phone number of enterprise owner</label
                    >

                    <div style="width: 50%; margin-bottom: -1rem">
                        <!-- <phone
                        :inputId="'phone-id'"
                        :value="phone"
                        name="phone"
                        v-model="registered_phone"
                        /> -->
                        <input type="text" class="form-control" v-model="registered_phone"/>
                    </div>
                    </div>

                    <div
                    class="text-center mx-auto"
                    style="display: flex; justify-content: center; padding: 2rem"
                    >
                    <button
                        :disabled="isLoading"
                        class="submit_event cp-btn"
                        style="padding: 1rem 5rem; background-color: #004e89"
                    >
                        <span
                        ><i v-if="isLoadingExit" class="fa fa-spinner fa-spin"></i
                        ></span>
                        SAVE & EXIT
                    </button>

                    <button
                        :disabled="isLoading"
                        class="cp-btn cp-btn-g-primary"
                        style="padding: 1rem 5rem; margin-left: 1rem"
                        id="submit_event_proceed"
                        @click="clickEventTriggerHousehold()"
                    >
                        <span
                        ><i v-if="isLoading" class="fa fa-spinner fa-spin"></i
                        ></span>
                        SAVE & PROCEED
                    </button>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
            </div>
            
        <div v-if="step == 3">
                <div class="cp-card" style="margin: 1rem 0rem 0 2rem; padding: 1rem">
        <div id="step0-view" class="content">
            <div class="">
            <div class="card-body">
                <div class="row">
                <div class="col">
                    <p class="h2" style="font-weight: 380">
                    Respondent and general household information
                    </p>
                    <hr />

                    <div class="form-group">
                    <label for="email"
                        >19. Do you belong to any agriculturally oriented group(s) in
                        this area</label
                    >
                    <div class="form-check mt-2">
                        <input
                        class="form-check-input"
                        type="radio"
                        name="gender"
                        id="owner-yes"
                        :value="1"
                        v-model="agric_oriented_group"
                        />
                        <label class="form-check-label" for="owner-yes">
                        Yes
                        </label>
                    </div>

                    <div class="form-check mt-2">
                        <input
                        class="form-check-input"
                        type="radio"
                        name="gender"
                        id="owner-no"
                        :value="0"
                        v-model="agric_oriented_group"
                        />
                        <label class="form-check-label" for="owner-no"> No </label>
                    </div>
                    </div>

                    <div
                    class="form-group"
                    v-if="agric_oriented_group == 1"
                    >
                    <label for="Subcounty">20. If Yes, What are the benefits?</label>

                    <input
                        type="text"
                        class="form-control col-6"
                        id="respondent"
                        aria-describedby="UserName"
                        v-model="benefits"
                        placeholder="Benefits"
                    />
                    </div>
                    <div
                    class="form-group"
                    v-if="agric_oriented_group == 1"
                    >
                    <label for="if-yes"
                        >21. If yes, is the group specific for poultry farmers?</label
                    >
                    <div class="form-check mt-2">
                        <input
                        class="form-check-input"
                        type="radio"
                        name="is_poultry_farmers"
                        id="is_poultry_farmers-yes"
                        v-model="is_poultry_farmers"
                        :value="1"
                        />
                        <label class="form-check-label" for="is_poultry_farmers-yes"> Yes </label>
                    </div>

                    <div class="form-check mt-2">
                        <input
                        class="form-check-input"
                        type="radio"
                        name="is_poultry_farmers"
                        id="is_poultry_farmers-no"
                        :value="0"
                        v-model="is_poultry_farmers"
                        />
                        <label class="form-check-label" for="is_poultry_farmers-no"> No </label>
                    </div>
                    </div>

                    <div
                    class="form-group"
                    v-if="agric_oriented_group == 0"
                    >
                    <label for="Subcounty">22. If No, Why?</label>

                    <input
                        type="text"
                        class="form-control col-6"
                        id="why-no"
                        aria-describedby="UserName"
                        v-model="why"
                        placeholder="Why"
                    />
                    </div>

                    <div
                    class="text-center mx-auto"
                    style="display: flex; justify-content: center; padding: 2rem"
                    >
                    <button
                        :disabled="isLoading"
                        class="submit_event cp-btn"
                        style="padding: 1rem 5rem; background-color: #004e89"
                    >
                        <span
                        ><i v-if="isLoadingExit" class="fa fa-spinner fa-spin"></i
                        ></span>
                        SAVE & EXIT
                    </button>

                    <button
                        :disabled="isLoading"
                        class="cp-btn cp-btn-g-primary"
                        style="padding: 1rem 5rem; margin-left: 1rem"
                        @click="clickEventTriggerThree()"
                        id="submit_event_proceed"
                    >
                        <span
                        ><i v-if="isLoading" class="fa fa-spinner fa-spin"></i
                        ></span>
                        SAVE & PROCEED
                    </button>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>   
            
            </div>
    
        <div v-if="step == 4">
                <div class="cp-card" style="margin: 1rem 0rem 0 2rem; padding: 1rem">
        <div id="step0-view" class="content">
            <div class="">
            <div class="card-body">
                <div class="row">
                <div class="col">
                    <p class="h2" style="font-weight: 380">
                    Egg Production Information
                    </p>
                    <hr />

                    <div class="form-group">
                    <label for="egg_date"
                        >23. When did you start egg production?</label
                    >

                    <input
                        type="date"
                        class="form-control col-6"
                        id="egg_date"
                        v-model="egg_production_date"
                        aria-describedby="egg_date"
                        required
                    />
                    </div>

                    <div class="form-group">
                    <label for="type_birds"
                        >24. Type of birds kept for egg laying</label
                    >
                    <select
                        class="form-control col-6"
                        v-model="type_of_birds"
                        id="type_birds"
                        required
                    >
                        <option value="">Select</option>
                        <option value="Dual purpose">Dual purpose</option>
                        <option value="Commercial Layers">Commercial Layers</option>
                        <option value="Indigenous">Indigenous</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="number_of_egg_laying_birds"
                        >25. Number of egg laying birds in terms of stock</label
                    >

                    <input
                        type="number"
                        v-model="number_of_egg_laying_birds"
                        class="form-control col-6"
                        id="number_of_egg_laying_birds"
                        aria-describedby="number_of_egg_laying_birds"
                        placeholder="Number"
                        required
                    />
                    </div>

                    <div class="form-group">
                    <label for="source_feeds_for_birds"
                        >26. What is the main source of feeds for the egg laying
                        birds?</label
                    >
                    <select
                        class="form-control col-6"
                        id="source_feeds_for_birds"
                        v-model="source_of_feeds"
                        required
                    >
                        <option value="">Select</option>
                        <option value="Home-made">Home-made</option>
                        <option value="Feeds manufacturer / agent (purchased)">
                        Feeds manufacturer / agent (purchased)
                        </option>
                        <option value="Both Home and purchased">
                        Both Home and purchased
                        </option>
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="source_of_birds"
                        >27. Source of Birds and Quality of stock</label
                    >

                    <div class="row" style="width:80%;margin-bottom:5px;margin-left:3px;padding-top: 5px;"
                    
                    >
                        <input
                        type="text"
                        class="form-control col-5"
                        id="source_of_birds"
                        aria-describedby="source_of_birds"
                        placeholder="Source of birds"
                        v-model="source_of_birds"
                        required
                        />
                        <select
                        class="form-control ml-2 col-5"
                        v-model="source_of_birds_quality"
                        required
                        >
                        <option value="">Select</option>
                        <option value="Good">Good</option>
                        <option value="Not Good">Not Good</option>
                        </select>

                    
                </div>
                <br>

                <div class="row"  style="width:80%;margin-bottom:5px;margin-left:3px;padding-top: 5px;"
                    
                    >
                        <input
                        type="text"
                        class="form-control col-5"
                        id="source_of_birds"
                        aria-describedby="source_of_birds"
                        placeholder="Source of birds"
                        v-model="source_of_birds_2"
                        required
                        />
                        <select
                        class="form-control ml-2 col-5"
                        v-model="source_of_birds_quality_2"
                        required
                        >
                        <option value="">Select</option>
                        <option value="Good">Good</option>
                        <option value="Not Good">Not Good</option>
                        </select>

                        </div>
                        <br>

                <div class="row" style="width:80%;margin-bottom:5px;margin-left:3px;padding-top: 5px;"
                    
                    >
                        <input
                        type="text"
                        class="form-control col-5"
                        id="source_of_birds"
                        aria-describedby="source_of_birds"
                        placeholder="Source of birds"
                        v-model="source_of_birds_3"
                        required
                        />
                        <select
                        class="form-control ml-2 col-5"
                        v-model="source_of_birds_quality_3"
                        required
                        >
                        <option value="">Select</option>
                        <option value="Good">Good</option>
                        <option value="Not Good">Not Good</option>
                        </select>
                
                </div>
                </div>

                    <div class="form-group">
                    <label for="number_of_cycles"
                        >28. How many cycles do you engage in per year?</label
                    >

                    <input
                        type="number"
                        class="form-control col-6"
                        id="number_of_cycles"
                        aria-describedby="number_of_cycles"
                        v-model="number_of_cycles"
                        placeholder="Cycles"
                        required
                    />
                    </div>

                    <div class="form-group">
                    <label for="records_kept_on_the_farm"
                        >29. What records do you keep at your farm?</label
                    >

                    <input
                        type="text"
                        class="form-control col-6"
                        id="records_kept_on_the_farm"
                        aria-describedby="records_kept_on_the_farm"
                        placeholder="Records"
                        v-model="records_kept_on_the_farm"
                        required
                    />
                    </div>

                    <div class="form-group">
                    <label for="labour_provider"
                        >30. Who provides the labour for managing the poulty operations
                        (Feeding, Cleaning, Egg collection)</label
                    >

                    <div class="row" style="width:80%;margin-bottom:5px;margin-left:3px;padding-top: 5px;"
                    
                    >
                        <select
                        class="form-control col-5"
                        v-model="labour_provider"
                        required
                        >
                        <option value="">Select About Source</option>
                        <option value="Men">Men</option>
                        <option value="Women">Women</option>
                        <option value="Children">Children</option>
                        <option value="Permanent Labour">Permanent Labour</option>
                        <option value="Casual Labour">Casual Labour</option>
                        </select>
                        <select
                        class="form-control ml-2 col-5"
                        v-model="labour_provider_frequency"
                        required
                        >
                        <option value="">Select</option>
                        <option value="Frequent">Frequent</option>
                        <option value="Occassionally">Occassionally</option>
                        </select>

                    </div>
                    <br>

                    <div class="row" style="width:80%;margin-bottom:5px;margin-left:3px;padding-top: 5px;"
                    
                    >
                        <select
                        class="form-control col-5"
                        v-model="labour_provider_2"
                        required
                        >
                        <option value="">Select About Source</option>
                        <option value="Men">Men</option>
                        <option value="Women">Women</option>
                        <option value="Children">Children</option>
                        <option value="Permanent Labour">Permanent Labour</option>
                        <option value="Casual Labour">Casual Labour</option>
                        </select>
                        <select
                        class="form-control ml-2 col-5"
                        v-model="labour_provider_frequency_2"
                        required
                        >
                        <option value="">Select</option>
                        <option value="Frequent">Frequent</option>
                        <option value="Occassionally">Occassionally</option>
                        </select>

                    </div>
                    <br>
                    <div class="row" style="width:80%;margin-bottom:5px;margin-left:3px;padding-top: 5px;"
                    
                    >
                        <select
                        class="form-control col-5"
                        v-model="labour_provider_3"
                        required
                        >
                        <option value="">Select About Source</option>
                        <option value="Men">Men</option>
                        <option value="Women">Women</option>
                        <option value="Children">Children</option>
                        <option value="Permanent Labour">Permanent Labour</option>
                        <option value="Casual Labour">Casual Labour</option>
                        </select>
                        <select
                        class="form-control ml-2 col-5"
                        v-model="labour_provider_frequency_3"
                        required
                        >
                        <option value="">Select</option>
                        <option value="Frequent">Frequent</option>
                        <option value="Occassionally">Occassionally</option>
                        </select>

                    </div>

                    </div>

                    <div class="form-group">
                    <label for="major_challenges"
                        >31. What are your major challenges and how do you address
                        them?</label
                    >

                    <div
                        style="display: flex"
                    
                    >
                        <input
                        type="text"
                        class="form-control col-5"
                        id="major_challenges"
                        aria-describedby="major_challenges"
                        placeholder="  Challenge"
                        v-model="challenges"
                        required
                        />

                        <input
                        type="text"
                        class="form-control ml-2 col-5"
                        id="major_challenges"
                        aria-describedby="major_challenges"
                        placeholder="  Solution"
                        v-model="solution"
                        required
                        />

                    </div>
                    </div>

                    <div
                    class="text-center mx-auto"
                    style="display: flex; justify-content: center; padding: 2rem"
                    >
                    <button
                        :disabled="isLoading"
                        class="submit_event cp-btn"
                        style="padding: 1rem 5rem; background-color: #004e89"
                    >
                        <span
                        ><i v-if="isLoadingExit" class="fa fa-spinner fa-spin"></i
                        ></span>
                        SAVE & EXIT
                    </button>

                    <button
                        :disabled="isLoading"
                        class="cp-btn cp-btn-g-primary"
                        style="padding: 1rem 5rem; margin-left: 1rem"
                        id="submit_event_proceed"
                        @click="clickEventTriggerFour()"
                    >
                        <span
                        ><i v-if="isLoading" class="fa fa-spinner fa-spin"></i
                        ></span>
                        SAVE & PROCEED
                    </button>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
            </div>
    
        <div v-if="step == 5">
        <div class="cp-card" style="margin: 1rem 0rem 0 2rem; padding: 1rem">
        <div id="step0-view" class="content">
            <div class="">
            <div class="card-body">
                <div class="row">
                <div class="col">
                    <p class="h2" style="font-weight: 380">Marketing</p>
                    <hr />

                    <div class="form-group">
                    <label for="trays_of_eggs"
                        >32. How many trays eggs do you collect per day?</label
                    >

                    <input
                        type="number"
                        class="form-control col-6"
                        id="trays_of_eggs"
                        aria-describedby="UserName"
                        placeholder="Trays"
                        v-model="trays_per_day"
                        required
                    />
                    </div>

                    <div class="form-group">
                    <label for="trays_of_eggs_weekly"
                        >33. How many trays eggs do you collect per week?</label
                    >

                    <input
                        type="number"
                        class="form-control col-6"
                        id="trays_of_eggs_weekly"
                        aria-describedby="UserName"
                        placeholder="Trays"
                        v-model="trays_per_week"
                        required
                    />
                    </div>

                    <div class="form-group">
                    <label for="price_range"
                        >34. What is the price range for a tray of eggs in your area (in
                        UGX)?</label
                    >

                    <div style="display: flex">
                        <input
                        type="number"
                        class="form-control col-4"
                        id="price_range"
                        aria-describedby="UserName"
                        placeholder="0"
                        v-model="first_range"
                        required
                        />
                        <div
                        class="col-1"
                        style="
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        >
                        -
                        </div>
                        <input
                        type="number"
                        class="form-control col-4"
                        aria-describedby="UserName"
                        v-model="second_range"
                        placeholder="0"
                        />
                    </div>
                    </div>

                    <div class="form-group">
                    <label for="trays_of_eggs_weekly"
                        >35. Where is your current market for the eggs?</label
                    >

                    <label class="box"
                        >(a) Local
                        <input
                        type="checkbox"
                        name="current_market"
                        value="Local"
                        v-model="current_market"
                        />
                        <span class="mark"></span>
                    </label>

                    <label class="box"
                        >(b) Middle Men
                        <input
                        type="checkbox"
                        name="current_market"
                        value="Middle Men"
                        v-model="current_market"
                        />
                        <span class="mark"></span>
                    </label>

                    <label class="box"
                        >(c) Bekeries
                        <input
                        type="checkbox"
                        name="current_market"
                        value="Bekeries"
                        v-model="current_market"
                        />
                        <span class="mark"></span>
                    </label>

                    <label class="box"
                        >(d) institutions- schools, hospitals
                        <input
                        type="checkbox"
                        name="current_market"
                        value="institutions- schools, hospitals"
                        v-model="current_market"
                        />
                        <span class="mark"></span>
                    </label>

                    <label class="box" style="display: flex"
                        >(e) others
                        <input
                        type="checkbox"
                        name="current_market"
                        value="others"
                        v-model="current_market"
                        />
                        <span class="mark"></span>
                        <input
                        v-if="current_market[4]"
                        type="text"
                        class="form-control ml-2 col-6"
                        id="others"
                        aria-describedby="UserName"
                        placeholder="Others"
                        v-model="current_market"
                        />
                    </label>
                    </div>

                    <div
                    class="text-center mx-auto"
                    style="display: flex; justify-content: center; padding: 2rem"
                    >
                    <button
                        :disabled="isLoading"
                        class="submit_event cp-btn"
                        style="padding: 1rem 5rem; background-color: #004e89"
                    >
                        <span
                        ><i v-if="isLoadingExit" class="fa fa-spinner fa-spin"></i
                        ></span>
                        SAVE & EXIT
                    </button>

                    <button
                        :disabled="isLoading"
                        class="cp-btn cp-btn-g-primary"
                        style="padding: 1rem 5rem; margin-left: 1rem"
                        id="submit_event_proceed"
                        @click="clickEventTriggerFive()"
                    >
                        <span
                        ><i v-if="isLoading" class="fa fa-spinner fa-spin"></i
                        ></span>
                        SAVE & PROCEED
                    </button>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
            </div>
    
        <div v-if="step == 6">
        <div class="cp-card" style="margin: 1rem 0rem 0 2rem; padding: 1rem">
        <div id="step0-view" class="content">
            <div class="">
            <div class="card-body">
                <div class="row">
                <div class="col">
                    <p class="h2" style="font-weight: 380">
                    Household Income during 2021
                    </p>
                    <hr />

                    <div class="form-group">
                    <label for="Village"
                        >36. What are your priority sources of income?</label
                    >
                    <div
                    
                        class="mt-2"
                    >
                        <select
                        class="form-control col-10"
                        id="Village"
                        v-model="income_source"
                        required
                        >
                        <option selected value="">Select Income source</option>
                        <option value="Sales of Eggs">Sale of Eggs</option>
                        <option value="Sale of off-layers">
                            Sale of off-layers
                        </option>
                        <option value="Regular employment">
                            Regular employment
                        </option>
                        <option value="Running own bussiness">
                            Running own bussiness
                        </option>
                        <option value="Others">
                            Others(Sale of crops, livestock, poultry litter,
                            Remittances from family/other members )
                        </option>
                        </select>
                        <div style="display: flex" class="mt-2">
                        <select
                            class="form-control col-4"
                            v-model="is_income_generating"
                            required
                        >
                            <option selected value="">
                            Do you get income from this source?
                            </option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>

                        <select
                            class="form-control ml-1 col-3"
                            v-model="who_gets_it"
                            required
                        >
                            <option selected value="">Who gets it?</option>
                            <option value="Household head">Household head</option>
                            <option value="Spouse">Spouse</option>
                            <option value="Other mebers">Other mebers</option>
                        </select>

                        <select
                            class="form-control ml-1 col-3"
                            v-model="who_spents_it"
                            required
                        >
                            <option selected value="">Who spends it?</option>
                            <option value="Household head">Household head</option>
                            <option value="Spouse">Spouse</option>
                            <option value="Other mebers">Other mebers</option>
                        </select>

                        
                        </div>
                    </div>
                    <div
                    
                    class="mt-2"
                    >
                    <select
                        class="form-control col-10"
                        id="Village"
                        v-model="income_source2"
                        required
                    >
                        <option selected value="">Select Income source</option>
                        <option value="Sales of Eggs">Sale of Eggs</option>
                        <option value="Sale of off-layers">
                        Sale of off-layers
                        </option>
                        <option value="Regular employment">
                        Regular employment
                        </option>
                        <option value="Running own bussiness">
                        Running own bussiness
                        </option>
                        <option value="Others">
                        Others(Sale of crops, livestock, poultry litter,
                        Remittances from family/other members )
                        </option>
                    </select>
                    <div style="display: flex" class="mt-2">
                        <select
                        class="form-control col-4"
                        v-model="is_income_generating2"
                        required
                        >
                        <option selected value="">
                            Do you get income from this source?
                        </option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                        </select>

                        <select
                        class="form-control ml-1 col-3"
                        v-model="who_gets_it2"
                        required
                        >
                        <option selected value="">Who gets it?</option>
                        <option value="Household head">Household head</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Other mebers">Other mebers</option>
                        </select>

                        <select
                        class="form-control ml-1 col-3"
                        v-model="who_spents_it2"
                        required
                        >
                        <option selected value="">Who spends it?</option>
                        <option value="Household head">Household head</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Other mebers">Other mebers</option>
                        </select>

                    
                    </div>
                    </div>
                    <div
                    
                    class="mt-2"
                    >
                    <select
                        class="form-control col-10"
                        id="Village"
                        v-model="income_source3"
                        required
                    >
                        <option selected value="">Select Income source</option>
                        <option value="Sales of Eggs">Sale of Eggs</option>
                        <option value="Sale of off-layers">
                        Sale of off-layers
                        </option>
                        <option value="Regular employment">
                        Regular employment
                        </option>
                        <option value="Running own bussiness">
                        Running own bussiness
                        </option>
                        <option value="Others">
                        Others(Sale of crops, livestock, poultry litter,
                        Remittances from family/other members )
                        </option>
                    </select>
                    <div style="display: flex" class="mt-2">
                        <select
                        class="form-control col-4"
                        v-model="is_income_generating3"
                        required
                        >
                        <option selected value="">
                            Do you get income from this source?
                        </option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                        </select>

                        <select
                        class="form-control ml-1 col-3"
                        v-model="who_gets_it3"
                        required
                        >
                        <option selected value="">Who gets it?</option>
                        <option value="Household head">Household head</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Other mebers">Other mebers</option>
                        </select>

                        <select
                        class="form-control ml-1 col-3"
                        v-model="who_spents_it3"
                        required
                        >
                        <option selected value="">Who spends it?</option>
                        <option value="Household head">Household head</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Other mebers">Other mebers</option>
                        </select>

                    
                    </div>
                    </div>
                    </div>
                    <div
                    class="text-center mx-auto"
                    style="
                        display: flex;

                        justify-content: center;
                        padding: 2rem;
                    "
                    >
                    <button
                        :disabled="isLoading"
                        class="submit_event cp-btn"
                        style="
                        padding: 1rem 5rem;

                        background-color: #004e89;
                        "
                    >
                        <span
                        ><i v-if="isLoadingExit" class="fa fa-spinner fa-spin"></i
                        ></span>
                        SAVE & EXIT
                    </button>

                    <button
                        :disabled="isLoading"
                        class="cp-btn cp-btn-g-primary"
                        style="padding: 1rem 5rem; margin-left: 1rem"
                        id="submit_event_proceed"
                        @click="saveStepSixDetails();"
                    >
                        <span
                        ><i v-if="isLoading" class="fa fa-spinner fa-spin"></i
                        ></span>
                        SAVE & PROCEED
                    </button>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
            </div>
        <div v-if="step == 7">
            <div class="cp-card" style="margin: 1rem 0rem 0 2rem; padding: 1rem">
      <div id="step0-view" class="content">
        <div class="">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <p class="h2" style="font-weight: 380">
                  Access to Market Information, Savings and Extension Services
                </p>
                <hr />

                <div class="form-group">
                  <label for="Village"
                    >37. Where do you primarily obtain market Information on price
                    eggs?</label
                  >
                  <select
                    class="form-control col-6"
                    id="Village"
                    v-model="market_information"
                    required
                  >
                    <option value="">Select</option>
                    <option value="Other Farmers">Other Farmers</option>
                    <option value="Family and friends">Family and friends</option>
                    <option value="Radio/TV">Radio/TV</option>
                    <option value="Farmer Organization/Cooperative">Farmer Organization/Cooperative</option>
                    <option value="Other non farmer associations">Other non farmer associations</option>
                    <option value="Market place posters/posted bulletin">Market place posters/posted bulletin</option>
                    <option value="Agricultural traders">Agricultural traders</option>
                    <option value="SMS messages">SMS messages</option>
                    <option value="Internet">Internet</option>
                    <option value="Newspaper">Newspaper</option>
                    <option value="Extension officer">Extension officer</option>
                  </select>
                </div>

                <div class="form-group">
                  <label
                    >38. Do you belong to any savings group or
                    organization?</label
                  >
                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="gender"
                      id="owner-yes"
                      v-model="belongs_to_saving_group"
                      :value="1"
                      required
                    />
                    <label class="form-check-label" for="owner-yes">
                      Yes
                    </label>
                  </div>

                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="gender"
                      id="owner-no"
                      :value="0"
                      v-model="belongs_to_saving_group"
                      required
                    />
                    <label class="form-check-label" for="owner-no"> No </label>
                  </div>
                </div>

                <div class="form-group" v-if="belongs_to_saving_group==1">
                  <label for="major_challenges"
                    >39. Indicate which savings group you belong to and the
                    type?</label
                  >

                  <div
                    style="display: flex"
                    class="mt-2"
                  >
                    <input
                      type="text"
                      class="form-control col-6"
                      id="major_challenges"
                      aria-describedby="major_challenges"
                      v-model="saving_group_name"
                      placeholder="  Name of the savings group"
                      required
                    />

                    <select
                      class="form-control ml-2 col-4"
                      v-model="saving_group_type"
                      required
                    >
                      <option value="">Select Type</option>
                      <option value="VSLA">VSLA</option>
                      <option value="SACCO">SACCO</option>
                      <option value="NGO">NGO</option>
                      <option value=" Bank or micro-finance institution"> Bank or micro-finance institution</option>
                      <option value="Cash rounds">Cash rounds</option>
                    </select>

                  </div>
                  <br/>
                  <div
                    style="display: flex"
                    class="mt-2"
                  >
                    <input
                      type="text"
                      class="form-control col-6"
                      id="major_challenges"
                      aria-describedby="major_challenges"
                      v-model="saving_group_name2"
                      placeholder="  Name of the savings group"
                      required
                    />

                    <select
                      class="form-control ml-2 col-4"
                      v-model="saving_group_type2"
                      required
                    >
                      <option value="">Select Type</option>
                      <option value="VSLA">VSLA</option>
                      <option value="SACCO">SACCO</option>
                      <option value="NGO">NGO</option>
                      <option value=" Bank or micro-finance institution"> Bank or micro-finance institution</option>
                      <option value="Cash rounds">Cash rounds</option>
                    </select>

                  </div>
                  <br/>
                  <div
                    style="display: flex"
                    class="mt-2"
                  >
                    <input
                      type="text"
                      class="form-control col-6"
                      id="major_challenges"
                      aria-describedby="major_challenges"
                      v-model="saving_group_name3"
                      placeholder="  Name of the savings group"
                      required
                    />

                    <select
                      class="form-control ml-2 col-4"
                      v-model="saving_group_type3"
                      required
                    >
                      <option value="">Select Type</option>
                      <option value="VSLA">VSLA</option>
                      <option value="SACCO">SACCO</option>
                      <option value="NGO">NGO</option>
                      <option value=" Bank or micro-finance institution"> Bank or micro-finance institution</option>
                      <option value="Cash rounds">Cash rounds</option>
                    </select>

                  </div>
                  <br/>
                </div>

                <div class="form-group">
                  <label
                    >40. Did anyone in your household consult an agricultural
                    extension agent or Veterinary Service provider for advice
                    during the last 12 months to seek advice or assistance on
                    egg production and/marketing ?</label
                  >
                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="consult"
                      id="owner-yes-consult"
                      v-model="consultation"
                      :value="1"
                    />
                    <label class="form-check-label" for="owner-yes-consult">
                      Yes
                    </label>
                  </div>

                  <div class="form-check mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="consult"
                      id="owner-no-consult"
                      v-model="consultation"
                      :value="0"
                    />
                    <label class="form-check-label" for="owner-no-consult">
                      No
                    </label>
                  </div>
                </div>

                <div class="form-group" v-if="consultation == 1">
                  <label for="number_of_consult"
                    >41. If Yes, How many times during the last 12 months did
                    members of your household consult</label
                  >
                  <input
                    type="number"
                    class="form-control col-6"
                    v-model="consultation_number"
                    id="number_of_consult"
                    aria-describedby="UserName"
                    placeholder="0"
                  />
                </div>
                <div class="form-group">
                  <label for="trays_of_eggs_weekly"
                    >42. What kind of assistance or Information was
                    requested?</label
                  >

                  <label class="box"
                    >(a) Farm Managment Practices
                    <input
                      type="checkbox"
                      name="current_market"
                      value=" Farm Managment Practices"
                      v-model="information_requested"
                      required
                    />
                    <span class="mark"></span>
                  </label>

                  <label class="box"
                    >(b) Use of improved poultry breeds
                    <input
                      type="checkbox"
                      name="current_market"
                      value="Use of improved poultry breeds"
                      v-model="information_requested"
                      required
                    />
                    <span class="mark"></span>
                  </label>

                  <label class="box"
                    >(c) Marketing
                    <input
                      type="checkbox"
                      name="current_market"
                      value="Marketing"
                      v-model="information_requested"
                      required
                    />
                    <span class="mark"></span>
                  </label>

                  <label class="box"
                    >(d) Financial Related
                    <input
                      type="checkbox"
                      value="Financial Related"
                      name="current_market"
                      v-model="information_requested"
                      required
                    />
                    <span class="mark"></span>
                  </label>

                  <label class="box" style="display: flex"
                    >(e) others
                    <input
                      type="checkbox"
                      value="others"
                      name="current_market"
                      v-model="information_requested"
                      required
                    />
                    <span class="mark"></span>
                    <input
                      type="text"
                      class="form-control ml-2 col-6"
                      id="others"
                      aria-describedby="UserName"
                      v-model="information_requested"
                      placeholder="Others"
                      required
                    />
                  </label>
                </div>

                <div class="form-group">
                  <label for="trainees"
                    >43. In which aspects of egg production and marketing would
                    you like to be trained, to better achieve your dreams for
                    this business?</label
                  >

                  <div
                    style="display: flex"
                    class="mt-2"
                  >
                    <input
                      type="text"
                      class="form-control col-10"
                      id="trainees"
                      aria-describedby="trainees"
                      placeholder="  Required Training "
                      v-model="required_training"
                      required
                    />
                                    
                  </div>
                </div>

                <div
                  class="text-center mx-auto"
                  style="display: flex; justify-content: center; padding: 2rem"
                >
                  <button
                    :disabled="isLoading"
                    class="submit_event cp-btn"
                    style="padding: 1rem 5rem; background-color: #004e89"
                  >
                    <span
                      ><i v-if="isLoadingExit" class="fa fa-spinner fa-spin"></i
                    ></span>
                    SAVE & EXIT
                  </button>

                  <button
                    :disabled="isLoading"
                    class="cp-btn cp-btn-g-primary"
                    style="padding: 1rem 5rem; margin-left: 1rem"
                    id="submit_event_proceed"
                    @click="saveStepSevenDetails()"
                  >
                    <span
                      ><i v-if="isLoading" class="fa fa-spinner fa-spin"></i
                    ></span>
                    SAVE & PROCEED
                            </button>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
          </div>

        </form>
        </div>
      </div>
      </div>
  </template>
  
  
  <script>
  import sideNavigation from "../../Layout/enumeratorLayout/sideNavigation.vue";
  import enumHeader from "../../Layout/enumeratorLayout/header.vue";
  import ProgressIndicator from "./progressIndicator.vue";
  import Izitoast from "../../mixins/IziToast";
  import Request from "../../mixins/requestHelper";
  import Phone from '../../common/Phone.vue';
  import MapView from '../../common/mapView.vue';
  export default {
    components: {
    ProgressIndicator,
    sideNavigation,
      Phone,
      MapView,
      enumHeader,
    },
    name: "farmer-profiling",
    props: {
        profile: {
            type: Object,
            required: true
        },
    },
    data() {
      return {
        step: 1,
        id: "",
        editData: false,
        phone: "",
        names: "",
        respondent_name: "",
        respondents_gender: "",
        respondents_date_of_birth:"",
        is_respondent_owner_of_enterprise: "",
        relationship_to_owner: "",
        enterprise_owner_date_of_birth: "",
        enterprise_owner_gender: "",
        enterprise_owner_marital_status: "",
        enterprise_owner_education_level: "",
        enterprise_owner_house_type: "",
        enterprise_owner_roofing_type: "",
        enterprise_owner_religion: "",
        agric_oriented_group: "",
        is_poultry_farmers: "",
        egg_production_date: "",
        type_of_birds: "",
        number_of_egg_laying_birds: "",
        source_of_feeds: "",
        source_of_birds: [],
        number_of_cycles: "",
        records_kept_on_the_farm: "",
        registered_phone: "",
        benefits: "",
        isLoading: false,
        isLoadingExit: "",
        districts: [],
        subCountyData: [],
        parishes: [],
        villages: [],
        form_stage: 0,
        phone: "",
        isLoading: false,
        isLoadingExit: false,
        income_source: "",
        is_income_generating: "",
        who_gets_it: "",
        who_spents_it: "",
        current_market: [],
        relationship_to_owner: "",
        trays_per_day: "",
        trays_per_week: "",
        first_range: "",
        second_range: "",
        current_market: "",
        income_source: "",
        is_income_generating: "",
        who_gets_it: "",
        who_spents_it: "",
        market_information: "",
        belongs_to_saving_group: "",
        saving_group_name: "",
        saving_group_type: "",
        saving_group_name2: "",
        saving_group_type2: "",
        saving_group_name3: "",
        saving_group_type3: "",
        consultation: "",
        consultation_number: "",
        information_requested: "",
        required_training: "",
        user: {},
        profileObject: null,
      

      };
    },
    mixins: [Izitoast],
    components: { Phone, MapView },

  
    mounted() {
        const app = this;
        app.user = Request.getUser();
        app.profileObject = app.profile;



// alert(JSON.stringify(app.editData));
if (app.editData.house_hold_info) {
  app.formData = JSON.parse(app.editData.address);
  //alert(JSON.stringify(app.formData))
}
  // alert(JSON.stringify(app.editData));
  if (app.editData.social_info) {
      app.formData = JSON.parse(app.editData.social_info);
      //alert(JSON.stringify(app.formData))
    }
},

watch: {
editData: function (newVal) {
  const app = this;
  // alert("Ok")
  // alert(JSON.stringify(app.editData));
  if (newVal && app.editData.address) {
    app.formData = JSON.parse(app.editData.address);

    //alert(JSON.stringify(app.formData))
    app.getSubCounty();
    app.getParish();
    app.getVillage();
  }
},
editDataSocial: function (newVal) {
      const app = this;
     // alert(JSON.stringify(app.editData));
      if (newVal&&app.editData.social_info) {
        app.formData = JSON.parse(app.editData.social_info);

        //alert(JSON.stringify(app.formData))
   
        
      }
    },
    },
  
    created() {
      const app = this;
      const id = this.$route.params.id;
      if (id) {
        app.getProfile(id);
      }
    },
    methods: {
      getProfile(id) {
        const app = this;
        Request.getMethod(`/api/enumerator/get-profile/${id}`)
          .then((response) => {
            app.editData = response.data;
            app.id = response.data.id;
          
            app.step =
              response.data.form_stage == 7 || response.data.form_stage == 0
                ? 1
                : response.data.form_stage;
             //console.log(response.data, '...')
          })
          .catch((error) => {
            console.log(error.response);
          });
      },
      clickEventTriggerEggProduction() {
      const app = this;
      var forms = document.querySelectorAll(".needs-validation");

      var btn = document.getElementById("submit_event_proceed");
      // Loop over them and prevent submission
      Array.prototype.slice.call(forms).forEach(function (form) {
        btn.addEventListener("click", app.handleListenerEggProduction(event, form), false);
      });
    },
     handleListenerEggProduction(event, form) {
      const app = this;
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add("was-validated");
    
        app.showErrorMessage(
          "Please make sure to fill all the required fields !"
        );

        return;
      }

      //alert("Not Perfect")

      form.classList.add("was-validated");
      // app.isLoading = true;

      app.saveProfileEggProduction();
      event.preventDefault();
      event.stopPropagation();
    },

    saveProfileEggProduction() {
      const app = this;

      const body = {
        formDetails: JSON.stringify(app.FormData),
        form_stage: 4,
        id: app.id,
      };

      app.isLoading = true;

      Request.postMethod("/api/enumerator/save-profile", body)
        .then((response) => {
          //console.log(response);
          var profile = response.data;
          profile.form_stage = 5;
          app.changeFormStage(profile);
          app.isLoading = false;
          app.showSuccessMessage("Profile Saved");
        })
        .catch((error) => {
          console.log(error.response);
          app.isLoading = false;

          app.showErrorMessage("Something went, please try again latter");
        });
    },
  
      clickEventTriggerSocial() {
      const app = this;
      var forms = document.querySelectorAll(".needs-validation");

      var btn = document.getElementById("submit_event_proceed");
      // Loop over them and prevent submission
      Array.prototype.slice.call(forms).forEach(function (form) {
        btn.addEventListener("click", app.handleListenerSocial(event, form), false);
      });
    },
    handleListenerSocial(event, form) {
      const app = this;
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add("was-validated");

        app.showErrorMessage(
          "Please make sure to fill all the required fields !"
        );

        return;
      }

      form.classList.add("was-validated");
    
      app.saveProfileSocial();
      event.preventDefault();
      event.stopPropagation();
    },
    prev() {
             this.step--;
         },
    next() {
             this.step++;
         },
      changeFormStage(obj) {
        const app = this;
        if (!app.id) {
          app.id = obj.id;
        }
        app.step = form_stage;
      },
      clickEventTriggerHousehold() {
      const app = this;
      var forms = document.querySelectorAll(".needs-validation");

      var btn = document.getElementById("submit_event_proceed");
      // Loop over them and prevent submission
      Array.prototype.slice.call(forms).forEach(function (form) {
        btn.addEventListener("click", app.handleListenerHousehold(event, form), false);
      });
    },
    //set location address

    onSetEvent(val) {
      const app = this;
      app.address = val;
    },
    saveProfileSocial() {
      const app = this;

      const body = {
        formDetails: JSON.stringify(app.formData),
        form_stage: 3,
        id: app.id,
      };

      app.isLoading = true;
      

      Request.postMethod("/api/enumerator/save-profile", body)
        .then((response) => {
          console.log(response);
          var profile = response.data;
          profile.form_stage = 4;
          app.changeFormStage(profile);
          app.isLoading = false;
          app.showSuccessMessage("Profile Saved");
        })
        .catch((error) => {
          console.log(error.response);
          app.isLoading = false;

          app.showErrorMessage("Something went, please try again latter");
        });
    },
  
    getDistricts() {
      //alert("Ok");
      const app = this;
      Request.getMethod("/api/enumerator/get-member-district")
        .then((response) => {
          console.log(response);
          app.districts = response.data;
        })
        .catch((error) => {
          //console.log(error.response);
        });
    },

    //get  sub county under selected district
    getSubCounty() {
      const app = this;

      const val = app.district;

      app.parishes = [];
      app.villages = [];
      app.subCountyData = [];

      Request.getMethod(`/api/enumerator/get-member-sub-county/${val}`)
        .then((response) => {
          //console.log(response);
          app.subCountyData = response.data;
        })
        .catch((error) => {
          //console.log(error.response);
        });
    },


    getParish() {
      let app = this;
      let form = $("#collect-data");
      app.parishes = [];
      let formData = new FormData();
      formData.append("sub_county", app.sub_county);
      formData.append("district", app.district);

        $.ajax({
          url: `/api/get-member-parish`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success(response) {
          app.parishes = response;
          console.log(parishes);
          },
        }); 
    },

    getVillage() {
      let app = this;
      let form = $("#collect-data");
      app.villages = [];
      let formData = new FormData();
      formData.append("sub_county", app.sub_county);
      formData.append("district", app.district);
      formData.append("parish", app.parish);


        $.ajax({
          url: `/api/get-member-village`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success(response) {
            app.villages = response;
          console.log(response);
          },
        }); 
    },
    setPhoneValue(val) {
      const app = this;
      app.formData["enterprise_phone"] = val;
    },

    handleListenerHousehold(event, form) {
      const app = this;
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add("was-validated");

        app.showErrorMessage(
          "Please make sure to fill all the required fields !"
        );

        return;
      }

      //alert("Not Perfect")

      form.classList.add("was-validated");
      // app.isLoading = true;

      app.saveProfileHousehold();
      event.preventDefault();
      event.stopPropagation();
    },
    addAddressDetails() {
      let app = this;
      let form = $("#collect-data");

      if (form.valid()) {
        app.isLoading = true;

        let formData = new FormData();
        formData.append('village', app.village);
        formData.append('district', app.district);
        formData.append('sub_county', app.sub_county);
        formData.append('parish', app.parish);
        formData.append('names', app.names);
        formData.append('email', app.email);
        formData.append('address', app.address);
        formData.append('collection_date', app.collection_date);
        formData.append('form_stage', 1);
        formData.append('id', app.id);

         $.ajax({
          url: `/api/save-farmer-profile`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
              success(response) {
                console.log(response);
                app.id = response;
          app.next();
          app.showSuccessMessage("Profile Saved");
          app.isLoading = false;

          },
        });      
      }
    },
    clickEventTriggerAddress() {
      const app = this;
      var forms = document.querySelectorAll(".needs-validation");

      var btn = document.getElementById("submit_event_proceed");
      Array.prototype.slice.call(forms).forEach(function (form) {
        btn.addEventListener("click", app.handleListenerAddress(event, form), false);
      });
    },

    handleListenerAddress(event, form) {
      const app = this;
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add("was-validated");

        app.showErrorMessage(
          "Please make sure to fill all the required fields !"
        );

        return;
      }

      //alert("Not Perfect")

      form.classList.add("was-validated");
      // app.isLoading = true;

      app.addAddressDetails();
      event.preventDefault();
      event.stopPropagation();
    },

    addHouseHoldDetails(){
        let app = this;
      let form = $("#collect-data");

      if (form) {
        app.isLoading = true;

        let formData = new FormData();
        formData.append('respondent_name', app.respondent_name);
        formData.append('respondents_gender', app.respondents_gender);
        formData.append('respondents_date_of_birth', app.respondents_date_of_birth);
        formData.append('is_respondent_owner_of_enterprise', app.is_respondent_owner_of_enterprise);
        formData.append('enterprise_owner_date_of_birth', app.enterprise_owner_date_of_birth);
        formData.append('enterprise_owner_gender', app.enterprise_owner_gender);
        formData.append('enterprise_owner_marital_status', app.enterprise_owner_marital_status);
        formData.append('enterprise_owner_education_level', app.enterprise_owner_education_level);
        formData.append('enterprise_owner_house_type', app.enterprise_owner_house_type);
        formData.append('enterprise_owner_roofing_type', app.enterprise_owner_roofing_type);
        formData.append('enterprise_owner_religion', app.enterprise_owner_religion);
        formData.append('registered_phone', app.registered_phone);
        formData.append('id', app.id);
        formData.append('form_stage', 2);

         $.ajax({
          url: `/api/save-household-details`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
              success() {
          app.next();
          app.showSuccessMessage("Profile Saved");
          app.isLoading = false;

          },
        });      
      }
    },
    clickEventTriggerHousehold() {
      const app = this;
      var forms = document.querySelectorAll(".needs-validation");

      var btn = document.getElementById("submit_event_proceed");
      Array.prototype.slice.call(forms).forEach(function (form) {
        btn.addEventListener("click", app.handleListenerHousehold(event, form), false);
      });
    },

    handleListenerHousehold(event, form) {
      const app = this;
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add("was-validated");
   
        app.showErrorMessage(
          "Please make sure to fill all the required fields !"
        );

        return;
      }

      //alert("Not Perfect")

      form.classList.add("was-validated");
      // app.isLoading = true;

      app.addHouseHoldDetails();
      event.preventDefault();
      event.stopPropagation();
    },

    saveStepThreeDetails(){
        let app = this;
      let form = $("#collect-data");

      if (form) {
        app.isLoading = true;

        let formData = new FormData();
        formData.append('agric_oriented_group', app.agric_oriented_group);
        formData.append('is_poultry_farmers', app.is_poultry_farmers);
        formData.append('benefits', app.benefits);
        formData.append('why', app.why);
        formData.append('id', app.id);
        formData.append('form_stage', 3);

        $.ajax({
          url: `/api/save-step-three`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
              success() {
          app.next();
          app.showSuccessMessage("Profile Saved");
          app.isLoading = false;

          },
        });      
      }
    },
    clickEventTriggerThree() {
      const app = this;
      var forms = document.querySelectorAll(".needs-validation");

      var btn = document.getElementById("submit_event_proceed");
      Array.prototype.slice.call(forms).forEach(function (form) {
        btn.addEventListener("click", app.handleListenerThree(event, form), false);
      });
    },

    handleListenerThree(event, form) {
      const app = this;
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add("was-validated");
   
        app.showErrorMessage(
          "Please make sure to fill all the required fields !"
        );

        return;
      }

      //alert("Not Perfect")

      form.classList.add("was-validated");
      // app.isLoading = true;

      app.saveStepThreeDetails();
      event.preventDefault();
      event.stopPropagation();
    },
    saveStepFourDetails(){
        let app = this;
      let form = $("#collect-data");

      if (form) {
        app.isLoading = true;

        let formData = new FormData();
        formData.append('egg_production_date', app.egg_production_date);
        formData.append('type_of_birds', app.type_of_birds);
        formData.append('number_of_egg_laying_birds', app.number_of_egg_laying_birds);
        formData.append('source_of_feeds', app.source_of_feeds);
        formData.append('source_of_birds',app.source_of_birds);
        formData.append('source_of_birds_quality',app.source_of_birds_quality);
        formData.append('source_of_birds_2',app.source_of_birds_2);
        formData.append('source_of_birds_quality_2',app.source_of_birds_quality_2);
        formData.append('source_of_birds_3',app.source_of_birds_3);
        formData.append('source_of_birds_quality_3',app.source_of_birds_quality_3);
        formData.append('number_of_cycles',app.number_of_cycles);
        formData.append('records_kept_on_the_farm',app.records_kept_on_the_farm);
        formData.append('labour_provider',app.labour_provider);
        formData.append('labour_provider_frequency',app.labour_provider_frequency);
        formData.append('labour_provider_2',app.labour_provider_2);
        formData.append('labour_provider_frequency_2',app.labour_provider_frequency_2);
        formData.append('labour_provider_3',app.labour_provider_3);
        formData.append('labour_provider_frequency_3',app.labour_provider_frequency_3);
        formData.append('challenges',app.challenges);
        formData.append('solution',app.solution);
        formData.append('form_stage', 4);
        formData.append('id', app.id);
      
        $.ajax({
          url: `/api/save-step-four`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
              success() {
          app.next();
          app.showSuccessMessage("Profile Saved");
          app.isLoading = false;

          },
        });      
      }
    },
    clickEventTriggerFour() {
      const app = this;
      var forms = document.querySelectorAll(".needs-validation");

      var btn = document.getElementById("submit_event_proceed");
      Array.prototype.slice.call(forms).forEach(function (form) {
        btn.addEventListener("click", app.handleListenerFour(event, form), false);
      });
    },

    handleListenerFour(event, form) {
      const app = this;
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add("was-validated");
        //alert(app.field_validation);

        //var elmntToView = document.getElementById("to_top_page");

        //elmntToView.scrollIntoView();

        //alert("Perfect");
        app.showErrorMessage(
          "Please make sure to fill all the required fields !"
        );

        return;
      }

      //alert("Not Perfect")

      form.classList.add("was-validated");
      // app.isLoading = true;

      app.saveStepFourDetails();
      event.preventDefault();
      event.stopPropagation();
    },

    saveStepFiveDetails(){
      let app = this;
      let form = $("#collect-data");

      if (form) {
        app.isLoading = true;

        let formData = new FormData();
        formData.append('trays_per_day', app.trays_per_day);
        formData.append('trays_per_week', app.trays_per_week);
        formData.append('first_range', app.first_range);
        formData.append('second_range', app.second_range);
        formData.append('current_market',app.current_market);
        formData.append('form_stage', 5);
        formData.append('id', app.id);

        $.ajax({
          url: `/api/save-step-five`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
              success() {
          app.next();
          app.showSuccessMessage("Profile Saved");
          app.isLoading = false;

          },
        });      
      }
    },
    clickEventTriggerFive() {
      const app = this;
      var forms = document.querySelectorAll(".needs-validation");

      var btn = document.getElementById("submit_event_proceed");
      Array.prototype.slice.call(forms).forEach(function (form) {
        btn.addEventListener("click", app.handleListenerFive(event, form), false);
      });
    },

    handleListenerFive(event, form) {
      const app = this;
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add("was-validated");

        app.showErrorMessage(
          "Please make sure to fill all the required fields !"
        );

        return;
      }

      //alert("Not Perfect")

      form.classList.add("was-validated");
      // app.isLoading = true;

      app.saveStepFiveDetails();
      event.preventDefault();
      event.stopPropagation();
    },

    saveStepSixDetails(){
      let app = this;
      let form = $("#collect-data");

      if (form) {
        app.isLoading = true;

        let formData = new FormData();
        formData.append('income_source', app.income_source);
        formData.append('is_income_generating', app.is_income_generating);
        formData.append('who_gets_it', app.who_gets_it);
        formData.append('who_spents_it', app.who_spents_it);
        formData.append('income_source3', app.income_source3);
        formData.append('is_income_generating3', app.is_income_generating3);
        formData.append('who_gets_it3', app.who_gets_it3);
        formData.append('who_spents_it3', app.who_spents_it3);
        formData.append('income_source2', app.income_source2);
        formData.append('is_income_generating2', app.is_income_generating2);
        formData.append('who_gets_it2', app.who_gets_it2);
        formData.append('who_spents_it2', app.who_spents_it2);
        formData.append('form_stage', 6);
        formData.append('id', app.id);

        $.ajax({
          url: `/api/save-step-six`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
              success() {
          app.next();
          app.showSuccessMessage("Profile Saved");
          app.isLoading = false;

          },
        });      
      }
    },
    clickEventTriggerSix() {
      const app = this;
      var forms = document.querySelectorAll(".needs-validation");

      var btn = document.getElementById("submit_event_proceed");
      Array.prototype.slice.call(forms).forEach(function (form) {
        btn.addEventListener("click", app.handleListenerSix(event, form), false);
      });
    },

    handleListenerSix(event, form) {
      const app = this;
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        app.showErrorMessage(
          "Please make sure to fill all the required fields !"
        );

        return;
      }

      form.classList.add("was-validated");
      // app.isLoading = true;

      app.saveStepSixDetails();
      event.preventDefault();
      event.stopPropagation();
    },

    saveStepSevenDetails(){
      let app = this;
      let form = $("#collect-data");

      if (form) {
        app.isLoading = true;

        let formData = new FormData();
        formData.append('market_information', app.market_information);
        formData.append('belongs_to_saving_group', app.belongs_to_saving_group);
        formData.append('saving_group_name', app.saving_group_name);
        formData.append('saving_group_type', app.saving_group_type);
        formData.append('saving_group_name2', app.saving_group_name2);
        formData.append('saving_group_type2', app.saving_group_type2);
        formData.append('saving_group_name3', app.saving_group_name3);
        formData.append('saving_group_type3', app.saving_group_type3);
        formData.append('consultation', app.consultation);
        formData.append('consultation_number', app.consultation_number);
        formData.append('information_requested', app.information_requested);
        formData.append('required_training', app.required_training);
        formData.append('form_stage', 7);
        formData.append('id', app.id);

        $.ajax({
          url: `/api/save-step-seven`,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
              success() {
             window.location.href='/enumerator-reports';

          app.showSuccessMessage("Profile Saved");
          app.isLoading = false;

          },
        });      
      }
    },
    clickEventTriggerSeven() {
      const app = this;
      var forms = document.querySelectorAll(".needs-validation");

      var btn = document.getElementById("submit_event_proceed");
      Array.prototype.slice.call(forms).forEach(function (form) {
        btn.addEventListener("click", app.handleListenerSeven(event, form), false);
      });
    },

    handleListenerSeven(event, form) {
      const app = this;
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add("was-validated");
   
        app.showErrorMessage(
          "Please make sure to fill all the required fields !"
        );

        return;
      }

      //alert("Not Perfect")

      form.classList.add("was-validated");
      // app.isLoading = true;

      app.saveStepSevenDetails();
      event.preventDefault();
      event.stopPropagation();
    },
    
   },

  created() {
    const app = this;

    //get  districts
    app.getDistricts();
  },

    
  };
  </script>
  
  <style scoped>
  select {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 0.75rem center;
  background-size: 16px 12px;
}

input[type="radio"] {
  display: none;
}

input[type="radio"] + label:before {
  content: "";
  display: inline-block;
  width: 30px;
  height: 30px;
  padding: 6px;
  margin-right: 4px;
  background-clip: content-box;
  border: 1px solid #448b51;

  border-radius: 50%;
}

input[type="radio"]:checked + label:before {
  background-color: #448b51;
}

input[type="checkbox"] {
  display: none;
}

input[type="checkbox"] + label:before {
  content: "";
  display: inline-block;
  width: 25px;
  height: 25px;
  padding: 6px;
  margin-right: 4px;
  background-clip: content-box;
  border: 1px solid #448b51;
  background-color: #ffffff;

  border-radius: 6px;
  margin-top: 5px;
}

.arrow {
  font-size: 20px;
}

.title_aligin {
  display: flex;
}

label {
  display: flex;
  align-items: center;
  margin-left: 2px;
  margin-bottom: 0.2 !important;
}

.padding_top_item {
  padding-bottom: 0.2rem;
}

.col-5 {
  padding: 0 !important;
}

.box {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 15px;
  cursor: pointer;
  font-size: 16px;
}

input[type="checkbox"] {
  visibility: hidden;
}

.label_title {
  margin-bottom: 0 !important;
  font-size: 16px;
  font-weight: 400;
  margin-top: 0.5rem;
  color: #000000;
}

.form-check {
  padding-left: 0 !important;
}
.mark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  border: 1px solid #448b51;
  background-color: #ffffff;
  border-radius: 6px;
}

.box input:checked + .mark {
  background-color: #448b51;
}

.mark:after {
  content: "";
  position: absolute;
  display: none;
}

.box input:checked + .mark:after {
  display: block;
}

.box .mark:after {
  left: 8px;
  bottom: 5px;
  width: 6px;
  height: 12px;
  border: solid #eee;
  border-width: 0 4px 4px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

.invalid-feedback_custom {
  width: 100%;
  margin-top: 0.25rem;
  font-size: 80%;
  color: #e3342f;
}

.artist-collection-photo {
  float: left;
  margin: 10px;
  cursor: pointer;
  width: 170px;
  height: 150px;
  position: relative;
}

.close {
  position: absolute;
  top: 0;
  right: 0;
  z-index: 9999;
  font-size: 20px;
  color: red;
  margin-top: 5px;
  margin-right: 10px;
}

.img-thumbnail {
  opacity: 1;
  transition: opacity 0.25s ease-in-out;
  -moz-transition: opacity 0.25s ease-in-out;
  -webkit-transition: opacity 0.25s ease-in-out;
}

.img-thumbnail:hover {
  opacity: 0.5;
}

label {
  font-size: 12pt !important;
}
.progress-container {
  display: flex;
  justify-content: center;
  align-items: center;
}
.line-active {
  background-color: #006d5c;
}
  </style>
  