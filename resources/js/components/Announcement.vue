<template>

<div>
  <div class="form-divider"></div>
  <div class="form-label-divider"><span>LIST</span></div>
  <div class="form-divider"></div>
<span v-for="announce in announcements" :key="announce.n_id">
  <div class="list-box">
    <a href="javascript:void(0);" class="list-item">
      <i class="fa fa-bullhorn"></i>
      <em class="seperate"></em>
      <span class="list-item-title"><a v-bind:href="''+root_link+announce.n_id+''"  data-loader="show">{{ announce.news_name}}</a></span>
    </a>
  </div>
  <div class="form-mini-divider"></div>
</span>
</div>

</template>

<script>

export default {

  data: function() {
      return {
              announcements : {},
              root_link : 'announcement/list/'
      };
  },
  mounted() {
      this.getAnnouncement();
  },
  methods: {
      getAnnouncement() {
          axios.get("/announcement/list").then(response => {
                this.announcements = response.data;
                console.log(response.data);
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
