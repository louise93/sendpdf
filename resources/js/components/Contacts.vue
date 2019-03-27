<template>
  <div class="row">
      <div class="col-sm-8">
          <div class="ibox">
              <div class="ibox-content">
                  <h2>Contact List</h2>
                  <p>
                      You can easily contact your downlines.
                  </p>
                  <div class="input-group">
                      <input type="text" placeholder="Search downlines " v-model="user_id" v-on:change="searchDownline()" class="input form-control">
                      <span class="input-group-append">
                              <button type="button" class="btn btn btn-primary" v-on:click="searchDownline()"> <i class="fa fa-search"></i> Search</button>
                      </span>
                  </div>
                  <div class="clients-list">
                  <span class="float-right small text-muted"></span>
                  <ul class="nav nav-tabs">
                      <li><a class="nav-link active" data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i> Contacts</a></li>
                      </ul>
                  <div class="tab-content">
                      <div id="tab-1" class="tab-pane active">
                          <div class="full-height-scroll">
                              <div class="table-responsive">
                                  <table class="table table-striped table-hover">
                                      <tbody>
                                      <tr v-for="client in  clients" v-on:click="clientInfo(client.user_id)">
                                          <td class="client-avatar">  <i class="fa fa-user fa-10x"></i> </td>
                                          <td> {{ client.user_id}} - {{ client.username}}</td>
                                          <td><a href="#contact-1" class="client-link">{{ client.first_name}} {{ client.last_name}}</a></td>
                                        
                                          <td class="contact-type"><i class="fa fa-envelope"> </i></td>

                                          <td> {{ client.email}}</td>
                                        <td class="contact-type"><i class="fa fa-mobile"> </i></td>
                                          <td class="client-status">{{ client.telephone}}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>

                  </div>

                  </div>
              </div>
          </div>
      </div>
      <div class="col-sm-4">
          <div class="ibox selected">

              <div class="ibox-content">
                  <div class="tab-content">
                      <div id="contact-1" class="tab-pane active">
                          <div class="row m-b-lg">
                              <div class="col-lg-4 text-center">
                                  <h2>{{ client_name }}</h2>

                                  <div class="m-b-sm">
                                        <i class="fa fa-user fa-10x"></i>
                                  </div>
                              </div>
                              <div class="col-lg-8">
                                  <strong>
                                      Address
                                  </strong>

                                  <p>
                                      {{ client_address }}
                                  </p>
                                  <!-- <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                          class="fa fa-envelope"></i> Send Message
                                  </button> -->
                              </div>
                          </div>
                          <div class="client-detail">
                          <div class="full-height-scroll">

                              <strong>Investment Details</strong>

                              <ul class="list-group clear-list">
                                  <li class="list-group-item fist-item">
                                      <span class="float-right"> $ {{ package }} </span>
                                      Package
                                  </li>
                                  <li class="list-group-item">
                                      <span class="float-right"> $ {{ ewallet }} </span>
                                        E Wallet
                                  </li>
                                  <li class="list-group-item">
                                      <span class="float-right"> $ {{ rwallet}} </span>
                                      R Wallet
                                  </li>
                                  <li class="list-group-item">
                                      <span class="float-right"> $ {{forexwallet}} </span>
                                      Forex Wallet
                                  </li>
                                  <li class="list-group-item">
                                      <span class="float-right"> $ {{ virtualwallet }} </span>
                                      Virtual Wallet
                                  </li>
                              </ul>




                              </div>
                          </div>
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
                    clients : {},
                    client : "",
                    client_name : "",
                    package : 0,
                    ewallet : 0 ,
                    rwallet : 0 ,
                    virtualwallet : 0 ,
                    forexwallet : 0,
                    client_address : "",
                    user_id : ""


            };
        },
        mounted() {
            this.clientList();

        },
         methods: {
             clientList(){
                 axios.get("contacts/list").then(response => {
                    this.clients = response.data;
                });
             },
             clientInfo(client_id){

               console.log(client_id);

               axios.post('contacts/getinfo',
                       {
                         'user_id' : client_id,
                        }
                        ).then(response => {
                          this.client_name = response.data.name;
                          this.client_address = response.data.address;
                          this.package = response.data.package;
                          this.ewallet = response.data.ewallet;
                          this.rwallet = response.data.rwallet;
                          this.virtualwallet = response.data.virtualwallet;
                          this.forexwallet = response.data.forexwallet;

                      });
             },
             searchDownline(){

               axios.post('contacts/searchdownline',
                       {
                         'user_id' : this.user_id,
                        }
                        ).then(response => {
                            this.clients = response.data;
                      });

             }


         }


      }

</script>
