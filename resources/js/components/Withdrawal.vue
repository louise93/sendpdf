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
      <div class="form-label-divider"><span>Wallet Widthdrawals</span></div>
      <div class="form-divider"></div>
      <div class="form-row no-padding">
        Type
      </div>
      <div class="form-row no-padding">
        <select class="form-element" name="type" v-model="type">
            <option value="Bankwire">Bankwire</option>
            <option value="BTC">Bitcoin</option>
        </select>

      </div>
        <div class="form-row no-padding">
          Amount
        </div>
        <div class="form-row no-padding">
          <i class="fa fa-money"></i>
          <input type="number" name="amount" v-model="amount" required class="form-element" placeholder="">
        </div>
        <div class="form-row no-padding">
          Transaction Password
        </div>
        <div class="form-row no-padding">
          <i class="fa fa-money"></i>
          <input type="password" name="t_code" v-model="t_code" required class="form-element" placeholder="">
        </div>
      <div class="form-divider"></div>

      <div class="form-row">
        <button id="btn_submit"  v-on:click="updateProfile()" class="button circle block orange">Withdraw</button>
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
              type : "" ,
              t_code : ""
      };
  },
  mounted() {
       this.getBalance();
  },
  methods: {
      getBalance(){

         axios.post('/internaltransfer/getBalance',
                 {
                   'from_wallet' : 'final_e_wallet'
                  }
                  ).then(response => {

                        this.balance = response.data;
                     //  this.getProfile()
                },error => {

                    //this.$notify.error('Something went wrong ! Please dont leave fields blank');
                    $('#btn_submit').html('Withdraw') ;
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
                    $('#btn_submit').html('Withdraw') ;
                 });

      },
      updateProfile() {
          $('#btn_submit').html('<i class="fa fa-spin fa-spinner"><i>') ;
          // if(this.new_password == this.confirm_password) {

            axios.post('/withdrawals/withdraw',
                    {
                      'from_wallet' : this.from_wallet,
                      'amount'      : this.amount,
                      'type'        : this.type,
                      't_code'      : this.t_code
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
                          $('#btn_submit').html('Withdraw') ;
                        //  this.getProfile()
                   },error => {

                       //this.$notify.error('Something went wrong ! Please dont leave fields blank');
                       $('#btn_submit').html('Withdraw') ;
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
