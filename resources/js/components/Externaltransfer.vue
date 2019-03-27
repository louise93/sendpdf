<template>
  <div>
  <section class="bal-section container">
    <div class="balance-card mb-15">
      <div class="d-flex align-items-center">
                    <div class="d-flex flex-grow">
                      <div class="mr-auto">
                        <h1 class="b-val"> Balance :   {{ balance}} USD</h1>
                        <!-- <p class="g-text mb-10">My Referrals</p> -->
                        <!-- <div class="badge badge-pill"> 18.98% <i class="fa fa-arrow-up ml-10"></i></div> -->
                      </div>
                      <div class="ml-auto align-self-end">
                        <div id="sparkline1"></div>
                      </div>
                    </div>
          </div>
      </div>
  </section>
    <div class="container">
      <div class="form-divider"></div>
      <div class="form-label-divider"><span>Wallet Transfer</span></div>
      <div class="form-divider"></div>
      <div class="form-row-group with-icons">
        <div class="form-row no-padding">
          From  (Wallet)
        </div>
        <div class="form-row no-padding">

          <select class="form-element" name="from_wallet" @change="getBalance()" v-model="from_wallet">
            <option value="final_r_wallet">R-Wallet</option>
            <option value="final_forex_wallet">Forex-Wallet</option>
            <option value="final_lotto_wallet">Lotto-Wallet</option>
            <option value="final_apin_wallet">Virtual-Wallet</option>
          </select>
        </div>
        <div class="form-row no-padding">
          To (Wallet)
        </div>
        <div class="form-row no-padding">

          <select class="form-element" name="to_wallet" v-model="to_wallet">
              <option value="final_r_wallet">R-Wallet</option>
              <option value="final_forex_wallet">Forex-Wallet</option>
              <option value="final_lotto_wallet">Lotto-Wallet</option>
              <option value="final_apin_wallet">Virtual-Wallet</option>
          </select>
        </div>
        <div class="form-row no-padding">
          Receiver  <small style="color:red;"> {{ user }}</small>
        </div>
        <div class="form-row no-padding">
          <i class="fa fa-money"></i>
          <input type="text" name="receiver"  @change="getReceiver()" v-model="receiver" required class="form-element" placeholder="">
        </div>
        <div class="form-row no-padding">
          Amount
        </div>
        <div class="form-row no-padding">
          <i class="fa fa-money"></i>
          <input type="number" name="amount" v-model="amount" required class="form-element" placeholder="">
        </div>

      <div class="form-divider"></div>

      <div class="form-row">
        <button id="btn_submit"  v-on:click="updateProfile()" class="button circle block orange">Transfer</button>
      </div>
    </div>
</div>
</div>
</template>

<script>

export default {

  data: function() {
      return {
              from_wallet : "" ,
              to_wallet : "" ,
              balance : 0,
              amount : 0 ,
              user : "" ,
      };
  },
  mounted() {
      //  this.getBalance();
  },
  methods: {
      getBalance(){

         axios.post('/internaltransfer/getBalance',
                 {
                   'from_wallet' : this.from_wallet,
                  }
                  ).then(response => {

                        this.balance = response.data;
                     //  this.getProfile()
                },error => {

                    //this.$notify.error('Something went wrong ! Please dont leave fields blank');
                    $('#btn_submit').html('Transfer') ;
                 });

      },
      getReceiver(){

         axios.post('/externaltransfer/getReceiver',
                 {
                   'user' : this.receiver,
                  }
                  ).then(response => {

                        this.user = response.data;
                     //  this.getProfile()
                },error => {

                    //this.$notify.error('Something went wrong ! Please dont leave fields blank');
                    $('#btn_submit').html('Transfer') ;
                 });

      },
      updateProfile() {
          $('#btn_submit').html('<i class="fa fa-spin fa-spinner"><i>') ;
          // if(this.new_password == this.confirm_password) {

            axios.post('/externaltransfer/transfer',
                    {
                      'from_wallet' : this.from_wallet,
                      'to_wallet'   : this.to_wallet,
                      'amount'      : this.amount,
                      'user'        : this.receiver
                     }
                     ).then(response => {

                          if(response.data.type =='success') {
                              this.$notify.success(response.data.message);
                              this.getBalance();
                          }
                          else {
                                this.$notify.error(response.data.message);
                                this.getBalance();
                          }
                          $('#btn_submit').html('Transfer') ;
                        //  this.getProfile()
                   },error => {

                       //this.$notify.error('Something went wrong ! Please dont leave fields blank');
                       $('#btn_submit').html('Transfer') ;
                    });
          // }
          // else {
          //
          //   this.$notify.error('New Password and Confrim Password do not match.');
          //   $('#btn_submit').html('Transfer') ;
          //
          // }

      },

  }

}
</script>
