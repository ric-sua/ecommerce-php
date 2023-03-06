<?php include('product_header.php');
?>
<div>
  <div uk-grid>
    <div class="uk-width-1-4@m">
      <ul class="accordian" uk-accordion="multiple: true">
        <li>
          <a class="uk-accordion-title" href="#">Brand</a>
          <div class="uk-accordion-content">
            <div ng-repeat="b in brd">
              <input type="checkbox" ng-click="includeBrand(b.manu)" ng-checked="bChecker(b.manu)" />
              <label for="{{ b.manu }}">{{ b.manu }}</label>
            </div>
          </div>
        </li>
        <li>
          <a class="uk-accordion-title" href="#">Price</a>
          <div class="uk-accordion-content">
          <label class="uk-form-label" for="form-stacked-text">MIN</label>
            <input class="uk-input" type="number" ng-model="min_prc" />
            <label class="uk-form-label" for="form-stacked-text">MAX</label>
            <input class="uk-input" type="number" ng-model="max_prc" />
          </div>
        </li>
        <li>
          <a class="uk-accordion-title" href="#">RAM</a>
          <div class="uk-accordion-content">
            <div ng-repeat="k in ram">
              <input type="checkbox" ng-click="includeRam(k.ram)" />
              <label for="{{ k.ram }}">{{ k.ram }}</label>
            </div>
          </div>
        </li>
        <li>
          <a class="uk-accordion-title" href="#">Category</a>
          <div class="uk-accordion-content">
            <div ng-repeat="k in cat">
              <input type="checkbox" ng-click="includeCat(k.cat)" ng-checked="checker(k.cat)" />
              <label for="{{ k.cat }}">{{ k.cat }}</label>
            </div>
          </div>
        </li>
        <ul>
    </div>

    <div class="uk-width-3-4@m">
      <div class="uk-grid-small uk-grid-match" uk-grid>



        <div class="uk-width-1-3@m" ng-repeat=" r in dat| filter: brandFilter | filter: priceFilter | filter: ramFilter | filter: catFilter | limitTo:qty | filter:query as m ">


          <div class="uk-card uk-card-default ty">
            <div class="uk-card-media-top">
            <a href="/product_details&proId={{r.id}}&specId={{r.sid}}"><img ng-src="view/{{r.img}}" alt="" width="1400" height="400"></a>
            </div>

            <div class="uk-card-body">
              <h3 class="uk-card-title"><a href="/product_details&proId={{r.id}}&specId={{r.sid}}">{{ r.name }}</a></h3>
              <p>{{ r.des }}</p>
              <div ng-if="r.disPer > 0">
                <p ng-init="disTotal = r.price * (1 - (r.disPer/100));"> <strike>${{ r.price }} </strike> &nbsp; <b> ${{disTotal.toFixed(2)}}</b> Save {{r.disPer}}% </p>
              </div>
              <div ng-if="r.disPer == 0">
                <p> <b>${{ r.price }}</b> </p>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div ng-if="!m.length"> 0 results found</div>
      <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom custom" style="margin-top: 20px;" ng-click="loadmore()">load more </button>
    </div>
  </div> <!-- uk grdi match div end -->
</div> <!-- uk width 3-4 div end -->

<script>
  let filterVal = "<?php echo $filter; ?>";
  var data = <?php echo $results; ?>;
  var app = angular.module("myApp", []);
  app.controller("customersCtrl", function($scope) {
      $scope.dat = data.records;
      $scope.cat = data.records.filter((v, i, a) => a.findIndex(t => (t.cat === v.cat)) === i);
      $scope.brd = data.records.filter((v, i, a) => a.findIndex(t => (t.manu === v.manu)) === i);
      $scope.ram = data.records.filter((v, i, a) => a.findIndex(t => (t.ram === v.ram)) === i);

      $scope.qty = 6;

      $scope.loadmore = function() {
        $scope.qty += 6;
      }


      $scope.brandIncludes = [];
      $scope.ramIncludes = [];
      $scope.catIncludes = [];


      $scope.min_prc = 0;
      $scope.max_prc = 4000;


      $scope.priceFilter = function(n) {
        return ((n.price * (1 - (n.disPer / 100))) > $scope.min_prc && (n.price * (1 - (n.disPer / 100))) < $scope.max_prc);
      }

      $scope.includeCat = function(ct) {
        let i = $scope.catIncludes.indexOf(ct);
        if (i > -1) {
          $scope.catIncludes.splice(i, 1);
        } else {
          $scope.catIncludes.push(ct);
        }
      };

      $scope.catFilter = function(h) {
        if ($scope.catIncludes.length > 0) {
          if ($scope.catIncludes.indexOf(h.cat) < 0)
            return;
        }

        return h;
      };


      $scope.includeBrand = function(brnd) {
        let i = $scope.brandIncludes.indexOf(brnd);
        if (i > -1) {
          $scope.brandIncludes.splice(i, 1);
        } else {
          $scope.brandIncludes.push(brnd);
        }
      };

      $scope.brandFilter = function(n) {
        if ($scope.brandIncludes.length > 0) {
          if (
            $scope.brandIncludes.indexOf(n.manu) < 0
          )
            return;
        }

        return n;
      };

      $scope.includeRam = function(rm) {
        let i = $scope.ramIncludes.indexOf(rm);
        if (i > -1) {
          $scope.ramIncludes.splice(i, 1);
        } else {
          $scope.ramIncludes.push(rm);
        }
      };

      $scope.ramFilter = function(k) {
        if ($scope.ramIncludes.length > 0) {
          if (
            $scope.ramIncludes.indexOf(k.ram) < 0
          )
            return;
        }

        return k;
      };
      if (filterVal) {

        if ($scope.dat.findIndex(a => a.cat == filterVal) > -1) {
          $scope.checker = function(ch) {
            if (ch == filterVal) {
              return true;
            }

            return false;
          }
          $scope.includeCat(filterVal);
          UIkit.accordion(".uk-accordion").toggle(3,false);
        } else if ($scope.dat.findIndex(a => a.manu == filterVal) > -1) {
          $scope.bChecker = function(k) {
            if (k == filterVal) {
              return true;
            }

            return false;
          }
          $scope.includeBrand(filterVal);
          UIkit.accordion(".uk-accordion").toggle(0,false);
        }
      }
    
  });
</script>
</br>
</br>

<?php include('../footer.php'); ?>