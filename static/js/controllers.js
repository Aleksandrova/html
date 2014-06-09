App.controller('BaseCtrl', ['$rootScope',
	function($rootScope) {
		$rootScope.$on('$stateChangeStart', function() {
			document.getElementById('mainmenu').className = '';
		});
	}
]);

App.controller('HomeCtrl', ['$scope', 'API',
	function($scope, API) {
		$scope.current = [];

		API.getHomeItems(3, function(data){
			$scope.current = data;
		});
	}
]);

App.controller('InterestCtrl', ['$scope', 'API', '$location', '$stateParams', '$rootScope',
	function($scope, API, $location, $stateParams, $rootScope) {
		$scope.articles = API.getInteresting().query();
	}
]);

App.controller('InterestSingleCtrl', ['$scope', '$stateParams',
	function($scope, $stateParams) {
		$scope.current = {};

		var find = function() {
			for (var i in $scope.articles) {
				if ($scope.articles[i].url == $stateParams.id) {
					$scope.current = $scope.articles[i];
					console.log($scope.current);
					break;
				}
			}
		};

		if ($scope.articles.$resolved) {
			find();
		} else {
			$scope.articles.$promise.then(find);
		}
	}
]);

App.controller('ProductCtrl', ['$scope', 'API', '$state', '$stateParams',
	function($scope, API, $state, $stateParams) {
		$scope.products = API.getProducts().query();
		$scope.category = null;

		$scope.$on('productcat', function(e, data) {
			$scope.category = data;
		});
	}
]);

App.controller('CategoryCtrl', ['$scope', '$stateParams',
	function($scope, $stateParams) {
		$scope.cat = $stateParams.id;
		$scope.$emit('productcat', $stateParams.id);
	}
]);

App.controller('ViewProductCtrl', ['$scope', '$stateParams',
	function($scope, $stateParams) {
		var find = function() {
			for (var i in $scope.products) {
				if ($scope.products[i].url == $stateParams.id) {
					$scope.product = $scope.products[i];
					break;
				}
			}
		};

		if ($scope.products.$resolved) {
			find();
		} else {
			$scope.products.$promise.then(find);
		}
	}
]);

App.controller('ContactCtrl', ['$scope',
	function($scope) {

		var pos = new google.maps.LatLng(43.4088963, 23.2318185);

		var mapCanvas = document.getElementById('map_canvas');
		var mapOptions = {
			center: pos,
			zoom: 17,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}

		var map = new google.maps.Map(map_canvas, mapOptions);

		new google.maps.Marker({
			position: pos,
			map: map,
			title: 'Fobos ER - Офис'
		});

	}
]);