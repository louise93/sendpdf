<template>
  <div>
  <section class="crypto container">
    <h4 class="title-main">Wallet Balance </h4>

  </section>
  <section class="container">
  			    	<div class="resources-card-wrapper ">
  						<div class="ref-statistics mr-10 ">
                              <img src="Nandova/img/content/ref-icon3.png" class="img-xs" alt="">
                            	<div class="d-flex flex-column ml-md-2">
  	                          	<h4 class="mt-10 mb-5 ">$ {{ ewallet_balance }}</h4>
  	                            <p class="text-muted font-weight-medium">E Wallet</p>
                          	</div>
  	                    </div>
  	                    <div class="ref-statistics ml-10">
                              <img src="Nandova/img/content/ref-icon3.png" class="img-xs" alt="">
                            	<div class="d-flex flex-column ml-md-2">
  	                          	<h4 class="mt-10 mb-5 ">$ {{ compoundingwallet_balance }} </h4>
  	                            <p class="text-muted font-weight-medium">Compounding Wallet</p>
                          	</div>
  	                    </div>
                        <div class="ref-statistics ml-10">
                              <img src="Nandova/img/content/ref-icon3.png" class="img-xs" alt="">
                             <div class="d-flex flex-column ml-md-2">
                               <h4 class="mt-10 mb-5 ">$ {{ forexwallet_balance }}</h4>
                               <p class="text-muted font-weight-medium">Forex Wallet</p>
                           </div>
                       </div>
  					</div>
  					<div class="resources-card-wrapper">
  						<div class="ref-statistics mr-10">
                              <img src="Nandova/img/content/ref-icon4.png" class="img-xs" alt="">
                            	<div class="d-flex flex-column ml-md-2">
  	                          	<h4 class="mt-10 mb-5 ">$ {{ rwallet_balance }}</h4>
  	                            <p class="text-muted font-weight-medium">R Wallet</p>
                          	</div>
  	                    </div>
  	                    <div class="ref-statistics ml-10">
                              <img src="Nandova/img/content/ref-icon4.png" class="img-xs" alt="">
                            	<div class="d-flex flex-column ml-md-2">
  	                          	<h4 class="mt-10 mb-5 ">$ {{ virtualwallet_balance }} </h4>
  	                            <p class="text-muted font-weight-medium">Virtuall Wallet</p>
                          	</div>
  	                    </div>
  					</div>
            <div class="resources-card-wrapper">
              <div class="ref-statistics mr-10">
                              <img src="Nandova/img/content/ref-icon1.png" class="img-xs" alt="">
                              <div class="d-flex flex-column ml-md-2">
                                <h4 class="mt-10 mb-5 ">{{ lottowallet_balance }}</h4>
                                <p class="text-muted font-weight-medium">Lotto Wallet</p>
                            </div>
                        </div>


            </div>
  			    </section>

</div>
</template>
<script>
    export default {
        data: function() {
            return {
                    rwallet_balance : 0.00,
                    ewallet_balance : 0.00,
                    virtualwallet_balance : 0.00,
                    forexwallet_balance : 0.00,
                    lottowallet_balance : 0.00,
                    compoundingwallet_balance : 0.00,
                    total_income  : 0.00 ,
                    matching_income : 0.00,
                    direct_income : 0.000,
                    profit_share_income : 0.00,
                    leadership_income : 0.00,
                    direct_members : 0,
                    left_members : 0,
                    right_members : 0,
                    left_points : 0 ,
                    right_points : 0
            };
        },
        mounted() {
            this.walletList();
            this.incomeSummary();
            this.matchingPoints();
            this.downlines();
        },
         methods: {
             walletList(){
                 axios.get("dashboard/balances").then(response => {
                    this.ewallet_balance = response.data.ewallet;
                    this.rwallet_balance = response.data.rwallet;
                    this.virtualwallet_balance = response.data.virtualwallet;
                    this.lottowallet_balance = response.data.lottowallet;
                    this.forexwallet_balance = response.data.forexwallet;
                    this.compoundingwallet_balance = response.data.compounding;
                });
             },
             incomeSummary() {
                 axios.get("dashboard/incomes").then(response => {
                    this.total_income = response.data.total_income;
                    this.direct_income = response.data.direct_income;
                    this.matching_income = response.data.matching_income;
                    this.profit_share_income = response.data.profit_share_income;
                    this.leadership_income = response.data.leadership_income;
                });

             },
             matchingPoints() {
                     axios.get("dashboard/matchingpoints").then(response => {
                        this.left_points = response.data.left_points;
                        this.right_points = response.data.right_points;
                    });
             },
             downlines() {
                     axios.get("dashboard/downlines").then(response => {
                        this.direct_members = response.data.direct_donwlines;
                        this.left_members = response.data.left_downlines;
                        this.right_members = response.data.right_downlines;
                    });
             }


         }
    }
</script>
