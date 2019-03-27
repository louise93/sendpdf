<template>
  <div class="row">
      <div class="col-lg-4">
      </div>
      <div class="col-lg-4">
          <div class="ibox ">
              <div class="ibox-content">
                  <div class="row">
                      <div class="col-sm-12">
                            <div class="form-group"><label>Account Number</label>
                               <input type="text" placeholder="Account Number" v-model="account_number"   class="form-control"></div>
                            <div class="form-group"><label>Account Name</label> <input type="text" placeholder="Account Name" v-model="account_name"   class="form-control"></div>
                            <div class="form-group"><label>Bank Name</label> <input type="text" placeholder="Bank Name" name="first_name" v-model="bank_name"   class="form-control"></div>
                            <div class="form-group"><label>Bank Branch</label> <input type="text" placeholder="Branch" name="telephone" v-model="branch_name"  class="form-control"></div>
                               <div class="form-group"><label>IFC/Swift Code</label> <input type="text" placeholder="IFC/Swift Code" name="zipcode" v-model="bank_code"   class="form-control"></div>
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
              account_number : "" ,
              account_name : "",
              bank_name : "",
              branch_name: "",
              bank_code : "" ,

      };
  },
  mounted() {
        this.getProfile();
  },
  methods: {
      getProfile(){
          axios.get("/profile/info").then(response => {
                this.account_name = response.data[0].account_name;
                this.account_number = response.data[0].account_number;
                this.bank_name = response.data[0].bank_name;
                this.branch_name = response.data[0].branch_name;
                this.bank_code = response.data[0].bank_code;

         });
      },
      updateProfile() {
          $('#btn_submit').html('<i class="fa fa-spin fa-spinner"><i>') ;
        axios.post('/profile/bankupdate',
                {
                  'account_name' : this.account_name,
                  'account_number' : this.account_number,
                  'bank_name' : this.bank_name ,
                  'branch_name' : this.branch_name ,
                  'bank_code' : this.bank_code
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
