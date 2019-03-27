<template>

    <div class="container">
      <div class="form-divider"></div>
      <div class="form-label-divider"><span>BASIC INFO</span></div>
      <div class="form-divider"></div>
      <div class="form-row-group with-icons">
        <div class="form-row no-padding">
          <i class="fa fa-user"></i>
          <input type="text" name="username" v-model="username" required class="form-element" placeholder="Username">
        </div>
        <div class="form-row no-padding">
          <i class="fa fa-user"></i>
          <input type="text" name="firstname" v-model="firstname" class="form-element" placeholder="Firstname">
        </div>
        <div class="form-row no-padding">
          <i class="fa fa-user"></i>
          <input type="text" name="lastname" v-model="lastname" class="form-element" placeholder="Lastname">
        </div>
        <div class="form-row no-padding">
          <i class="fa fa-envelope"></i>
          <input type="email" name="email" class="form-element" readonly v-model="email" placeholder="Email">
        </div>
        <div class="form-row no-padding">
          <i class="fa fa-mobile 2x"></i>
          <input type="text" name="phone" class="form-element" readonly v-model="phone" placeholder="Contact Number">
        </div>
        <div class="form-row no-padding">
          <i class="fa fa-calendar"></i>
          <input type="date" name="dob" class="form-element" v-model="dob" placeholder="DOB">
        </div>
        <!-- <div class="form-row no-padding">
          <i class="fa fa-lock"></i>
          <input type="password" name="aaa" class="form-element" placeholder="Password">
        </div> -->
        <div class="form-row no-padding">
          <i class="fa fa-language"></i>
          <select class="form-element" name="gender" v-model="gender">
            <option value="">Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
      </div>

      <div class="form-divider"></div>
      <div class="form-label-divider"><span>ADDRESS</span></div>
      <div class="form-divider"></div>

      <div class="form-row-group with-icons">
        <div class="form-row no-padding">
          <i class="fa fa-language"></i>
          <input type="text" name="country" v-model="country" class="form-element" placeholder="Country">
        </div>
      </div>
      <div class="form-row-group with-icons">
        <div class="form-row no-padding">
          <i class="fa fa-building"></i>
          <input type="text" name="city" v-model="city" class="form-element" placeholder="City">
        </div>
      </div>
      <div class="form-row-group with-icons">
        <div class="form-row no-padding">
          <i class="fa fa-building"></i>
          <input type="text" name="state" v-model="state" class="form-element" placeholder="State/Province">
        </div>
      </div>
      <div class="form-row-group with-icons">
        <div class="form-row no-padding">
          <i class="fa fa-building"></i>
          <input type="text" name="zipcode" v-model="zipcode" class="form-element" placeholder="Postal/Zipcode">
        </div>
      </div>
      <div class="form-mini-divider"></div>

      <div class="form-row-group with-icons">
        <div class="form-row no-padding">
          <i class="fa fa-address-book-o"></i>
          <textarea class="form-element" v-model="address" placeholder="Residential Adress"></textarea>
        </div>
      </div>
      <div class="form-divider"></div>

      <div class="form-row">
        <button id="btn_submit"  v-on:click="updateProfile()" class="button circle block orange">Update</button>
      </div>
    </div>

</template>

<script>

export default {

  data: function() {
      return {
              username : "" ,
              firstname : "",
              lastname : "",
              email: "",
              phone : "" ,
              gender : "" ,
              dob : "" ,
              country: "" ,
              city : "" ,
              state : "" ,
              zipcode :  "" ,
              address: "",
      };
  },
  mounted() {
        this.getProfile();
  },
  methods: {
      getProfile(){
          axios.get("/profile/info").then(response => {
                this.username = response.data[0].username;
                this.firstname = response.data[0].first_name;
                this.lastname = response.data[0].last_name;
                this.email = response.data[0].email;
                this.phone = response.data[0].telephone;
                this.dob = response.data[0].dob;
                this.gender = response.data[0].sex;
                this.country = response.data[0].country;
                this.city = response.data[0].city;
                this.state = response.data[0].state;
                this.zipcode = response.data[0].zipcode;
                this.address = response.data[0].address;
         });
      },
      updateProfile() {
          $('#btn_submit').html('<i class="fa fa-spin fa-spinner"><i>') ;
        axios.post('/profile/update',
                {
                  'username' : this.username,
                  'first_name' : this.firstname,
                  'last_name' : this.lastname ,
                  'email' : this.email ,
                  'telephone' : this.phone ,
                  'dob' : this.dob ,
                  'sex' : this.gender ,
                  'country' : this.country ,
                  'city' : this.city ,
                  'state' : this.state ,
                  'zipcode' : this.zipcode ,
                  'address' :  this.address
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
      },

  }

}
</script>
