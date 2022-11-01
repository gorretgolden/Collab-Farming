<template>
 <div class="login-page">
    <!-- login page -->

    <div class="row">
      <div class="col-md-6 left-side">
        <div class="h-100 d-flex justify-content-center align-items-center">
          <div class="col-md-6">
            <!--
            <h1
              class="cp-h2"
              style="color: #ffffff; font-size: 30px !important"
            >
              Coop Profiler
            </h1>
            <h5
              class="mt-5 mb-3"
              style="color: #ffffff; font-size: 20px !important"
            >
              Get to know your Cooperatives and Members better. Resilience is
              one Step away.
            </h5>

            <button
              class="btn btn-primary rounded-pill sign-up mt-4 mb-3"
              data-toggle="modal"
              data-target="#cp-sign-up-dialog"
            >
              SIGN UP
            </button>

            <hr style="background: #ffffff; width: 70%" />

            <h5
              @click.prevent="showMobileDownloadModal"
              class="mt-3 text-white mt-3 clickable"
            >
              <span
                ><i class="fas fa-mobile-alt" style="font-size: 28px"></i
              ></span>
              <span
                style="padding-left: 8px !important; font-size: 18px !important"
                >Go Mobile</span
              >
            </h5>
            !-->
          </div>
        </div>
      </div>
      <div class="col-md-6 right-side">
        <div
          class="
            d-flex
            justify-content-center
            align-items-center
            login-container
          "
        >
          <div class="col-md-7" style="max-width: 100% !important">
            <div class="text-center">
              <img src="images/icon/logo2.png" style="height: 45px" />
            </div>
            <h3 style="text-align: center" class="mt-2">Welcome</h3>
            <form class="mt-3" @submit.prevent="login()">
              <div class="uhuru-input-group mb-3">
                <input
                  type="email"
                  class="form-control"
                  v-model="email"
                  name="email"
                  placeholder="Email Address"
                  autocomplete="off"
                  required
                />
                <div class="uhuru-input-icon">
                  <i class="far fa-envelope"></i>
                </div>
              </div>

              <div class="uhuru-input-group mb-3">
                <input
                  type="password"
                  class="form-control"
                  v-model="password"
                  name="password"
                  placeholder="Password"
                  required
                />
                <div class="uhuru-input-icon">
                  <i class="fa fa-lock"></i>
                </div>
              </div>

              <div class="text-right w-100 mt-2">
                <p class="font-weight-bold" style="font-size: 18px !important">
                  <a href="{{route('password.request')}}">Forgotten Password</a>
                </p>
              </div>

              <button
                type="submit"
                class="cp-btn cp-btn-g-primary cp-block mt-2 mb-2"
              >
                <span style="margin-right: 5%"
                  ><i v-if="isLoading" class="fa fa-spinner fa-spin"></i></span
                >LOGIN
              </button>

              <!--
              <div class="text-start w-100">
                <p style="font-size: 18px !important">
                  Don't have an account,
                  <span class="fw-bold"
                    ><a
                      href="#"
                      class="font-weight-bold"
                      data-toggle="modal"
                      data-target="#cp-sign-up-dialog"
                      >Create one</a
                    ></span
                  >
                </p>
              </div>
              -->
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- registration -->

    <form id="registerForm">
      <div class="modal" id="cp-sign-up-dialog" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <div class="cp-login-signup-form">
                <div class="row justify-content-center">
                  <div class="col mb-4">
                    <div class="text-center">
                      <img
                        src="images/logo.Coop Profiler.1.png"
                        style="height: 90px"
                      />
                    </div>
                  </div>
                </div>
                <div class="row justify-content-center">
                  <div class="col-md-10">
                    <div class="uhuru-input-group mb-3">
                      <input
                        type="text"
                        v-model="user.cooperativeName"
                        name="cooperativeName"
                        class="form-control"
                        placeholder="Registered Cooperative Name (in Full)"
                        autocomplete="false"
                        required
                      />
                      <div class="uhuru-input-icon"></div>
                    </div>
                    <div class="uhuru-input-group mb-3">
                      <input
                        type="email"
                        v-model="user.email"
                        name="email"
                        class="form-control"
                        placeholder="Email Address"
                        autocomplete="off"
                        required
                      />
                      <div class="uhuru-input-icon">
                        <i class="far fa-envelope"></i>
                      </div>
                    </div>
                    <div class="uhuru-input-group">
                      <phone input-id="contact_phone" name="contact_phone" />
                      <div class="uhuru-input-icon">
                        <i class="fa fa-phone"></i>
                      </div>
                    </div>
                    <div class="uhuru-input-group mb-3">
                      <input
                        type="password"
                        v-model="user.password"
                        name="password"
                        class="form-control"
                        placeholder="Password"
                        autocomplete="off"
                        required
                      />
                      <div class="uhuru-input-icon">
                        <i class="fa fa-lock"></i>
                      </div>
                    </div>

                    <div class="uhuru-input-group mb-3">
                      <select
                        class="form-control"
                        aria-label="Select"
                        name="c_type"
                        required
                        v-model="user.c_type"
                      >
                        <option :value="undefined" disabled>
                          Select Cooperative Type
                        </option>
                        <option :value="1">Primary Cooperative</option>

                        <option :value="6">Group</option>
                        <option :value="2">Secondary Cooperative</option>
                        <option :value="3">Tertiary Cooperative</option>
                        <option :value="4">
                          National Apexes/Confederation
                        </option>

                        <option :value="5">
                          International Cooperative Alliance
                        </option>
                      </select>
                      <div class="uhuru-input-icon">
                        <i class="fa fa-angle-down"></i>
                      </div>
                    </div>
                    <button
                      type="button"
                      @click.prevent="createAccount()"
                      id="register-btn"
                      name="register-btn"
                      class="cp-btn cp-btn-g-primary cp-block mt-2 mb-4"
                    >
                      <span style="margin-right: 5%"
                        ><i
                          v-if="loading"
                          class="fa fa-spinner fa-spin"
                        ></i></span
                      >Create Account
                    </button>
                  </div>
                  <div class="row justify-content-center text-center">
                    <div class="col-md-8">
                      By Joining, You Agree to the Terms and Conditions
                    </div>
                  </div>
                  <div
                    class="row justify-content-center text-center"
                    style="margin-top: -1%"
                  >
                    <div class="col-md-8 mb-4">
                      I already have an account?<a
                        href="#"
                        class="font-weight-bold text-secondary"
                        @click="closeModal()"
                      >
                        Sign In</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- verification code -->

    <div class="modal" id="cp-info-dialog" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="row justify-content-center mt-4 mb-4">
              <div class="col-md-14">
                <h2>Create Cooperative Account</h2>
              </div>
            </div>
            <div class="d-flex justify-content-center mb-4">
              <div class="col-md-12">
                <div class="bs-stepper">
                  <div class="col-md-10">
                    <div class="d-flex justify-content-center">
                      <div class="bs-stepper-header mb-4">
                        <div class="step" data-target="#step1-view">
                          <button
                            type="button"
                            class="btn step-trigger"
                            :class="{ active: step >= 1 }"
                          >
                            <span class="bs-stepper-circle"
                              ><i class="fa fa-check"></i
                            ></span>
                            <br />
                            <span class="bs-stepper-label"
                              >Cooperative Details</span
                            >
                          </button>
                        </div>
                        <div class="line" :class="{ active: step >= 1 }"></div>
                        <div class="step" data-target="#step2-view">
                          <button
                            type="button"
                            class="btn step-trigger"
                            :class="{ active: step >= 2 }"
                          >
                            <span v-if="step >= 2" class="bs-stepper-circle"
                              ><i class="fa fa-check"></i
                            ></span>
                            <span v-else class="bs-stepper-circle">2</span>
                            <br />
                            <span class="bs-stepper-label"
                              >Confirm Account</span
                            >
                          </button>
                        </div>
                        <div class="line" :class="{ active: step >= 2 }"></div>
                        <div class="step" data-target="#step3-view">
                          <button
                            type="button"
                            class="btn step-trigger"
                            :class="{ active: step >= 3 }"
                          >
                            <span v-if="step >= 3" class="bs-stepper-circle"
                              ><i class="fa fa-check"></i
                            ></span>
                            <span v-else class="bs-stepper-circle">3</span>
                            <br />
                            <span class="bs-stepper-label"
                              >Complete Registration</span
                            >
                          </button>
                        </div>
                        <div class="line" :class="{ active: step >= 3 }"></div>
                        <div class="step" data-target="#step4-view">
                          <button
                            type="button"
                            class="btn step-trigger"
                            :class="{ active: step >= 4 }"
                          >
                            <span v-if="step >= 4" class="bs-stepper-circle"
                              ><i class="fa fa-check"></i
                            ></span>
                            <span v-else class="bs-stepper-circle">4</span>
                            <br />
                            <span class="bs-stepper-label">View Dashboard</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="bs-stepper-content">
                    <!-- step 1 begins -->
                    <div id="step1-view" class="content"></div>
                    <!-- step 2 begins -->
                    <div id="step2-view" class="content">
                      <div
                        class="cp-login-signup-form"
                        v-if="displayCodeField == false"
                      >
                        <div class="row justify-content-center mb-3">
                          <div class="col-md-2">
                            <i
                              class="fa fa-envelope"
                              style="color: #999; font-size: 100px"
                            ></i>
                          </div>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-md-8">
                            <p class="h5 text-justify">
                              We've sent a 6 digit code to your email. Kindly
                              logon to your email, then follow the instructions
                              (be sure to check your trash incase the email
                              ended up there)
                            </p>
                          </div>
                        </div>
                      </div>
                      <div v-else>
                        <form id="verify-code">
                          <div class="row justify-content-center mb-4">
                            <div class="col-md-8">
                              <p class="h5">
                                We've sent a 6 digit code to your email. Kindly
                                logon to your email, get the code and enter it
                                below.
                              </p>
                            </div>
                          </div>
                          <div
                            id="code"
                            class="row justify-content-center mb-4"
                          >
                            <div class="uhuru-input-group mb-3">
                              <input
                                type="text"
                                v-model="user.code"
                                name="verificationCode"
                                class="form-control"
                                placeholder="Enter 6 digit code here"
                                autocomplete="false"
                                required
                              />
                              <div class="uhuru-input-icon"></div>
                            </div>
                            <!--                                                        <CodeInput :loading="false" class="input" v-on:change="onChange" v-on:complete="onComplete" />-->
                          </div>
                          <div class="row justify-content-center">
                            <div class="col-md-7">
                              <button
                                type="button"
                                id="verify-btn"
                                @click.prevent="verifyCode()"
                                class="
                                  cp-btn cp-btn-g-primary cp-block
                                  mt-2
                                  mb-4
                                "
                              >
                                <span style="margin-right: 5%"
                                  ><i
                                    v-if="loading"
                                    class="fa fa-spinner fa-spin"
                                  ></i></span
                                >CONFIRM CODE
                              </button>     this.$router.push({ path: "/login", replace: true });
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div id="step3-view" class="content">
                      <div class="row justify-content-center">
                        <div class="col-md-10"></div>
                      </div>
                    </div>
                    <div id="step4-view" class="content">
                      <div class="row justify-content-center">
                        <div class="col-md-10"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile Download Modal -->
    <div
      id="mobile-download-modal"
      class="modal fade"
      tabindex="-1"
      role="dialog"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-5">
            <div class="row">
              <div class="col-md-6">
                <img
                  src="images/mobile_phone.png"
                  alt="Cooprofiler"
                  width="400px"
                  height="400px"
                />
              </div>
              <div style="position: relative" class="col-md-6">
                <div style="position: absolute; top: 20%">
                  <h3 style="color: #585b84">Profile your cooperative</h3>
                  <h3
                    style="color: #585b84; font-weight: bold"
                    class="text-bold"
                  >
                    On the Go
                  </h3>

                  <h6 class="mt-3">Select your platform of choice</h6>
                  <h6>Download and install the app</h6>
                  <h6>Login, follow the instructions</h6>
                  <div class="justify-content-center w-100 mt-3">
                    <a href="/download-android-app">
                      <img
                        src="images/google-play.png"
                        alt="Cooprofiler"
                        width="150px"
                        height="45px"
                      />
                    </a>
                    <a href="#">
                      <img
                        src="images/app-store.png"
                        alt="Cooprofiler"
                        width="150px"
                        height="45px"
                      />
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import IziToast from "../mixins/IziToast";
import Phone from "../common/Phone.vue";
import CodeInput from "vue-verification-code-input";
import Request from "../mixins/requestHelper";
export default {
  name: "login",
  mixins: [IziToast],
  components: { Phone, CodeInput },
  data() {
    return {
      step: 1,
      loading: false,
      isLoading: false,
      email: "",
      password: "",
      displayCodeField: false,
      user: {
        email: "",
        password: "",
        cooperativeName: "",
        phone: "",
        code: "",
        token: "",
      },
    };
  },
  mounted() {
    let app = this;
    let link = window.location.href;
    const url = new URL(link);

    if (url.searchParams.get("t") != null) {
      app.displayCodeField = true;
      $("#cp-info-dialog").modal("show");
      app.user.token = url.searchParams.get("t");
    } else {
      app.displayCodeField = false;
    }

    let stepper1 = document.querySelector(".bs-stepper");

    if ($(".bs-stepper").length > 0) {
      app.stepper = new Stepper(stepper1);
    }

    // hide reset button at step 1
    stepper1.addEventListener("show.bs-stepper", function (e) {});

    if (app.step == 1) {
      app.step = 2;
      app.stepper.to(app.step);
    } else if (app.step == 2) {
      app.step = 3;
      app.stepper.to(app.step);
    }
  },
  methods: {
    showMobileDownloadModal() {
      $("#mobile-download-modal").modal("show");
    },
    openModal(modal) {
      $(".modal").modal("hide");
      $("#" + modal).modal("show");
    },
    closeModal() {
      $(".modal").modal("hide");
    },
    createAccount() {
      let app = this;

      let form = $("#registerForm");

      /*
      app.user.phone = $("#contact_phone").val();

      if (!form.valid()) {
        return app.showErrorMessage("Please fill in the form");
      }

      if (app.user.cooperativeName == "") {
        return app.showErrorMessage("Please enter the cooperative name");
      }

      if (app.user.email == "") {
        return app.showErrorMessage("Please enter the email");
      }

      if (app.user.password == "") {
        return app.showErrorMessage("Please enter the password");
      }

      if (app.user.phone == "") {
        return app.showErrorMessage("Please enter the phone number");
      }

      */

      let formData = app.user;

      Request.postMethod("/oauth/login", formData)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(erro);
        });

      app.loading = true;
      $("#register-btn").disabled;
    },
    onChange(v) {},
    onComplete(v) {
      let app = this;
      // app.user.code = v;
    },
    verifyCode() {
      let app = this;

      if (app.user.code === "") {
        return app.showErrorMessage("Please enter the code");
      }

      let formData = new FormData();
      formData.append("code", app.user.code);
      formData.append("auth", app.user.token);

      app.loading = true;
      $("#verify-btn").disabled;

      $.ajax({
        url: "/api/code/verify",
        type: "POST",
        dataType: "JSON",
        contentType: false,
        processData: false,
        data: formData,
        success: function (response) {
          app.loading = false;
          $("#cp-info-dialog").modal("hide");
          window.location.href = "/login-with-token?token=" + app.user.token;
        },
        error: function (xhr) {
          app.loading = false;
        },
      });
    },

    getUser() {
      Request.getMethod("/api/user")
        .then((response) => {
          console.log(response);
          if (response.data) {
            localStorage.setItem("User", JSON.stringify(response.data));
            app.isLoading = false;

            this.$router.push({ path: "/", replace: true });

            // window.location.href='/';
          }
          // console.log(response)
        })
        .catch((error) => {
          console.log(error);
        });
    },

    login() {
      let app = this;

      app.isLoading = true;

      if (app.email == "") {
        return app.showErrorMessage("Please enter the email");
      }

      if (app.password == "") {
        return app.showErrorMessage("Please enter the password");
      }

      // app.user.username = app.user.email;

      let formData = {
        username: app.email,
        password: app.password,
      };

      // alert("Ok")W

      // console.log(formData);

      Request.postMethod("/api/login", formData)
        .then((response) => {
          //console.log(response);
          if (response.data) {
            window.localStorage.setItem("Token", JSON.stringify(response.data));
            app.getUser();
          }
        })
        .catch((error) => {
          app.isLoading = false;

          app.showErrorMessage("Invalid Credentials");
          console.log(error.response);
        });
    },
  },
};
</script>
<style scoped>
</style>
