@extends('layouts.app')  

@section('body_tag')
<body class="home blog logged-in"> 
@endsection                                

@section('content')

	<script src="{{ url('/') }}/public/libraries/js/angular.js"></script>
    <script type="text/javascript">
        var myApp = angular.module('myApp', [], function ($interpolateProvider) {
            $interpolateProvider.startSymbol('<% ');
            $interpolateProvider.endSymbol(' %>');
        });

        function MyCtrl($scope, $http) {
            $scope.filter = {};
			
            $http.get("{{ URL::to('/')}}/getProducts")
                 .success(function (response) {
                        $scope.names = response;      
						
                        $scope.getCategories = function () {
                        return ($scope.names || []).map(function (w) {
                            return w.category_name;
                        }).filter(function (w, idx, arr) {
                            return arr.indexOf(w) === idx;
                        });
                    };                      
                    });
                    
               $scope.filterByCategory = function (wine) {
                return $scope.filter[wine.category_name] || noFilter($scope.filter);
                };
             

            function noFilter(filterObj) {
                for (var key in filterObj) {
                    if (filterObj[key]) {
                        return false;
                    }
                }
                return true;
            }
        
        }
    </script>
	
	<div class="search_result">
			<div class="container">
				<div class="row">
					<div class="search_inner"  ng-app="myApp" ng-controller="MyCtrl">
						<div class="col-xs-12">
							<div class="search_for">
								Search Results: <span class="result_here"> <% searchByItem %> </span>
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<div class="search_here">
								<div class="search_by_categories">
									<ul>
										<li ng-repeat="cat in getCategories()">
										 <b><label><input type="checkbox" ng-model="filter[cat]" /> <% cat %></b>
										<a href="#" class=" hvr-wobble-horizontal">(<% (names | filter:cat).length %>)</a>
										</li>
										
									</ul>
								</div>
								
							</div>
						</div>
						<div class="col-md-9 col-sm-12">
							<div class="block-items no-margin mjob-list-container">
								<ul class="row list-mjobs">			
									<!-- item 1 start -->
								 	<li ng-if="!names.length" class="col-lg-4 col-md-4 col-sm-4 col-xs-6 mjob-item animation-element animated" nameAnimation="zoomIn">
										Sorry! No Item Found.
									</li>
							
									<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6 mjob-item animation-element animated product-box" nameAnimation="zoomIn" ng-repeat="item in filtered = (names | filter:filterByCategory)">
										<div class="inner clearfix">
											<div class="vote">
												<div class="rate-it star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
												<span class="total-review">(22)</span>
											</div>
											<div class="set-status">
												<a href="{{ url('/') }}/product-details/<% item.product_name %>"><img src="{{url('/public')}}/uploads/products/<% item.product_image %>" alt="image" style="max-width:265px;max-height:160px"></a>
											</div>
											<h2 class="name-job"><a href="{{ url('/') }}/product-details/<% item.product_name %>"><% item.product_name %></a></h2>
											
											<div class="price">
												<span><sup>$</sup><% item.product_price %></span>
											</div>
										</div>
									</li>
									<!-- item 1 end -->									
								</ul>
								<!--div class="row">
									<div class="paginations-wrapper">
										<a href="#" class="previous-page"><i class="fa fa-angle-left"></i></a>
										<a href="#" class="page-numbers current">1</a>
										<a href="#" class="page-numbers">2</a>
										<a href="#" class="page-numbers">3</a>
										<a href="#" class="page-numbers">...</a>
										<a href="#" class="page-numbers">15</a>
										<a href="#" class="next-page"><i class="fa fa-angle-right"></i></a>
									</div>
								</div-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

@endsection
