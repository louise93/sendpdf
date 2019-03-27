<template>
  <div class="container">
    <div class="form-divider"></div>
    <div class="form-label-divider"><span>BASIC INFO</span></div>
    <div class="form-divider"></div>
    <div class="form-row-group with-icons">
      <form>

          <input type="hidden" name="pl_id" v-model="pl_id">
          <input type="hidden" name="position" v-model="position">
          <input type="hidden" name="sponsor_id" v-model="sponsor_id">
          <div class="form-row no-padding">
              <label>Username</label>
          </div>
          <div class="form-row no-padding">
            <i class="fa fa-user"></i>
            <input type="text" name="username" v-model="username" required class="form-element" >
          </div>
          <div class="form-row no-padding">
              <label>Firstname</label>
          </div>
          <div class="form-row no-padding">
            <i class="fa fa-user"></i>
            <input type="text" name="first_name" v-model="first_name" class="form-element" >
          </div>
          <div class="form-row no-padding">
              <label>Lastname</label>
          </div>
          <div class="form-row no-padding">
            <i class="fa fa-user"></i>
            <input type="text" name="last_name" v-model="last_name"  class="form-element" >
          </div>
          <div class="form-row no-padding">
              <label>Email</label>
          </div>
          <div class="form-row no-padding">
            <i class="fa fa-calendar"></i>
            <input type="email" name="email" class="form-element" v-model="email">
          </div>
          <div class="form-row no-padding">
          <label>Select Package</label>
          </div>
          <div class="form-row no-padding">

            <select class="form-element" name="package" v-model="package">
                <option value="1">100</option>
                <option value="2">200</option>
                <option value="3">1000</option>
                <option value="4">3000</option>
                <option value="5">5000</option>
            </select>
          </div>
          <div class="form-row no-padding">
          <label>Payment Type</label>
          </div>
          <div class="form-row no-padding">

            <select class="form-element" name="payment_type" v-model="payment_type">
                <option value="Virtual Wallet">Virtual Wallet</option>
                <option value="R Wallet">R Wallet</option>
                <option value="Virtual Wallet + R Wallet">50% R + 50% Virtual Wallet</option>
            </select>
          </div>
            <div class="form-divider"></div>
          <div class="form-row">
            <button type="button" v-on:click="registerUser()" id="btn_submit"   class="button circle block orange">Submit</button>
          </div>

        </form>
  </div>
  </div>
</template>

<script>

export default {

  data: function() {
      return {
              username : "" ,
              first_name : "",
              last_name : "",
              email: "",
              phone : "" ,
              gender : "" ,
              dob : "" ,
              country: "" ,
              city : "" ,
              state : "" ,
              zipcode :  "" ,
              address: "",
              package:"",
              payment_type : "",

      };
  },
  props : ['pl_id','position' ,'sponsor_id'],
    mounted() {
  },
  methods: {

      registerUser() {
          $('#btn_submit').html('<i class="fa fa-spin fa-spinner"><i>') ;
        axios.post('/genealogy/create',
                      {
                        'username' : this.username,
                        'first_name' : this.first_name,
                        'last_name' : this.last_name ,
                        'email'     : this.email ,
                        'payment_type'     : this.payment_type,
                        'package'   : this.package,
                        'pl_id'     : this.pl_id,
                        'position'  : this.position,
                        'sponsor_id' : this.sponsor_id

                       }
                 ).then(response => {

                      if(response.data.type =='success') {
                          this.$notify.success(response.data.message);
                      }
                      else {
                            this.$notify.error(response.data.message);
                      }
                      $('#btn_submit').html('Submit') ;

               },error => {

                   this.$notify.error('Something went wrong ! Please dont leave fields blank');
                   $('#btn_submit').html('Submit') ;
                });
      },

  }

}
</script>
