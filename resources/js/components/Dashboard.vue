<template>
  <div class="row">
      <div class="col-lg-3">
          <div class="widget style1">
                  <div class="row">
                      <div class="col-4 text-center">
                          <i class="fa fa-money fa-5x"></i>
                      </div>
                      <div class="col-8 text-right">
                          <span> Total Income </span>
                          <h2 class="font-bold">$ {{total_income}}
                          </h2>
                      </div>
                  </div>
          </div>
      </div>
      <div class="col-lg-3">
          <div class="widget style1 navy-bg">
              <div class="row">
                  <div class="col-4">
                      <i class="fa fa-money fa-5x"></i>
                  </div>
                  <div class="col-8 text-right">
                      <span> Direct Income </span>
                      <h2 class="font-bold">$
                            {{ direct_income}}
                      </h2>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-3">
          <div class="widget style1 lazur-bg">
              <div class="row">
                  <div class="col-4">
                      <i class="fa fa-money fa-5x"></i>
                  </div>
                  <div class="col-8 text-right">
                      <span> Matching Income </span>
                      <h2 class="font-bold">$ {{matching_income}}</h2>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-3">
          <div class="widget style1 yellow-bg">
              <div class="row">
                  <div class="col-4">
                      <i class="fa fa-money fa-5x"></i>
                  </div>
                  <div class="col-8 text-right">
                      <span> ROI </span>
                      <h2 class="font-bold">$ {{ profit_share_income }}</h2>
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
                    rwallet_balance : 0.00,
                    ewallet_balance : 0.00,
                    virtualwallet_balance : 0.00,
                    forexwallet_balance : 0.00,
                    lottowallet_balance : 0.00,
                    compoundingwallet_balance : 0.00,
                    total_income  : 0.00 ,
                    matching_income : 0.00,
                    direct_income : 0.00,
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
