<template>
  <div class="row">
      <div class="col-lg-4">
      </div>
      <div class="col-lg-4">
          <div class="ibox ">
              <div class="ibox-content">
                  <div class="row">
                      <div class="col-sm-12">
                            <div class="form-group"><label>Bitcoin Address</label>
                               <input type="text" placeholder="Bitcoin Address" v-model="gtb_wallet_address"   class="form-control"></div>
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
              gtb_wallet_address : "" ,
              isValid : false

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
      checkAddress() {
        var  WAValidator  = require('wallet-address-validator');
        var valid = WAValidator.validate(this.gtb_wallet_address, 'BTC');
            if(valid)
                this.isValid =true;
            else
              this.isValid = false;
      },
      updateProfile() {
          $('#btn_submit').html('<i class="fa fa-spin fa-spinner"><i>') ;
          this.checkAddress();
          if (this.isValid) {
            axios.post('/profile/walletupdate',
                    {
                      'gtb_wallet_address' : this.gtb_wallet_address,
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
          } else {
            this.$notify.error('Invalid Bitcoin Address');
            $('#btn_submit').html('Update') ;
          }


      },

  }

}
</script>
