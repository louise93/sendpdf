<template>
  <div class="form-group">
    <label>Receiver</label>
      <input type="text" class="form-control" name="receiver_id" v-on:change="getProfile()" v-model="receiver" placeholder="User ID/Username" required="">
      <small class="text-success" id="rc">{{receiver_id}}</small>
  </div>

</template>
<script>

export default {

  data: function() {
      return {
              gtb_wallet_address : "" ,
              receiver_id : "Please Select Receiver"

      };
  },
  mounted() {
        this.getProfile();

  },
  methods: {
      getProfile(){
        axios.post('/wallets/receiver',
                {
                  'user' : this.receiver,
                 }
                 ).then(response => {

                          console.log(response);
                          this.receiver_id = response.data;


               },error => {

                });
      },


  }

}
</script>
