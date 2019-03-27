
<template>
  <div class="row">
      <div class="col-lg-4">
      </div>
      <div class="col-lg-4">
          <div class="ibox ">
            <div class="ibox-title">
                <h3>Forgot your current password ? </h3>
                <a href="/reset/password" target="_blank" class="btn btn-link text-success" >Click here</a>
            </div>
              <div class="ibox-content">
                  <div class="row">
                      <div class="col-sm-12">
                            <div class="form-group"><label>Current Password</label>
                               <input type="password" placeholder="" v-model="password"   class="form-control">

                             </div>
                             <div class="form-group"><label>New Password</label>
                                <input type="password" placeholder="" v-model="new_password"   class="form-control">

                              </div>
                              <div class="form-group"><label>Confirm Password</label>
                                 <input type="password" placeholder="" v-model="confirm_password"   class="form-control">

                               </div>
                              <div class="form-group">
                                    <button id="btn_submit" v-on:click="updateProfile()" class="btn btn-info">Update</button>
                                  </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      </div>

</template>

<script>

export default {

  data: function() {
      return {
              password : "" ,
              new_password : "" ,
              confirm_password : "" ,

      };
  },
  mounted() {
        this.getProfile();
  },
  methods: {
      getProfile(){
          axios.get("/profile/info").then(response => {
                this.gtb_wallet_address = response.data[0].gtb_wallet_address;

         });
      },
      updateProfile() {
          $('#btn_submit').html('<i class="fa fa-spin fa-spinner"><i>') ;

          if(this.new_password == this.confirm_password) {


            axios.post('/profile/passwordupdate',
                    {
                      'password' : this.password,
                      'new_password' : this.new_password,
                      'confirm_password' : this.confirm_password

                     }
                     ).then(response => {

                          if(response.data.type =='success') {
                              this.$notify.success(response.data.message);
                          }
                          else {
                                this.$notify.error(response.data.message);
                          }
                          $('#btn_submit').html('Update') ;
                          this.getProfile()
                   },error => {

                       this.$notify.error('Something went wrong ! Please dont leave fields blank');
                       $('#btn_submit').html('Update') ;
                    });
          }
          else {

            this.$notify.error('New Password and Confrim Password do not match.');
            $('#btn_submit').html('Update') ;

          }

      },

  }

}
</script>
