<template>


    <div class="row">
        <div class="col-md-6 left-side">
            <div class="h-100 d-flex justify-content-center align-items-center">
                <div class="col-md-6">

                </div>
            </div>
        </div>
        <div class="col-md-6 right-side">
            <div class="
              d-flex
              justify-content-center
              align-items-center
              login-container
            ">
                <div class="col-md-7" style="max-width: 100% !important">
                    <div class="text-center">
                        <img src="images/icon/logo2.png" style="height: 45px" />
                    </div>
                    <h3 style="text-align: center" class="mt-2">Reset Your password</h3>
                    <p>We will email you instructions to reset your password</p>

                    <form class="mt-3"  v-on:submit.prevent="onSubmit">
                        <div class="uhuru-input-group mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email Address"
                                autocomplete="off" required />
                            <div class="uhuru-input-icon">
                                <i class="far fa-envelope"></i>
                            </div>
                        </div>


                        <button type="submit" class="cp-btn cp-btn-g-primary cp-block mt-2 mb-2">
                            <span style="margin-right: 5%"><i class="fa fa-spinner fa-spin"></i></span>LOGIN
                        </button>


                        -->
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
  name: "ResetUserPassword",
  data(){

    user:{
        email:''
    }
  },
  methods:{

    onSubmit:async function(){

    }

  }
}
</script>
