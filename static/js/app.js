var App = angular.module('Fobos', ['ngResource', 'ui.router', 'ngAnimate']);
var path = '/new';

App.config(
	['$stateProvider', '$urlRouterProvider', '$locationProvider', '$sceProvider',
		function($stateProvider, $urlRouterProvider, $locationProvider, $sceProvider) {
			$sceProvider.enabled(false);

			$urlRouterProvider
				.when('/new/interesting', '/new/interesting/znaehte-li')
				.when('/new/products', '/new/products/cat/kuhnenski-rolki');

			$stateProvider
				.state("home", {
					url: "/new/",
					templateUrl: path + '/partials/home.html',
					title: 'Начало',
					controller: 'HomeCtrl'
				})
				.state("products", {
					url: "/new/products",
					templateUrl: path + '/partials/products.html',
					controller: 'ProductCtrl',
					title: 'Продукти'
				})
				.state("products.category", {
					url: "/cat/:id",
					controller: 'CategoryCtrl',
					templateUrl: path + '/partials/products.template.html',
					title: 'Продукти'
				})
				.state("products.view", {
					url: "/:id",
					controller: 'ViewProductCtrl',
					templateUrl: path + '/partials/products.single.html',
					title: 'Продукти'
				})
				.state("interesting", {
					url: "/new/interesting",
					templateUrl: path + '/partials/interesting.html',
					controller: 'InterestCtrl',
					title: 'Интерестно'
				})
				.state("interesting.page", {
					url: "/:id",
					controller: 'InterestSingleCtrl',
					templateUrl: path + '/partials/interesting.single.html',
					title: 'Интерестно'
				})
				.state('about', {
					url: '/new/about',
					templateUrl: path + '/partials/about.html',
					title: 'За нас'
				})
				.state('contacts', {
					url: '/new/contacts',
					templateUrl: path + '/partials/contacts.html',
					controller: 'ContactCtrl',
					title: 'Контакти'
				});

			$locationProvider.html5Mode(true);
		}
	]
);

App.run(['$rootScope', '$state',
	function($rootScope, $state) {
		$rootScope.$on("$stateChangeSuccess", function(currentRoute, previousRoute) {
			$rootScope.$state = $state;
		});
	}
]);

App.factory('API', ['$resource',
	function($resource) {
		var randomId = function(len) {
			return Math.floor(Math.random() * len);
		}

		return {
			getInteresting: function() {
				return $resource('/api/interesting.json');
			},
			getProducts: function() {
				return $resource('/api/products.json');
			},
			getHomeItems: function(count, cb) {
				var data = this.getProducts().query();
				data.$promise.then(function(res) {
					var output = [];
					var added = [];
					var random;
					for (var i = 0; i < count; i++) {
						while(added.indexOf(random = randomId(res.length)) != -1 );
						output.push(res[random]);
						added.push(random);
					}
					cb(output);
				});
			}
		}
	}
]);

App.filter('dots', function() {
	return function(input, len) {
		len = len || 80;
		input = input.substr(0, len) + '..';
		return input;
	}
});

App.filter('category', function() {
	return function(items, cat) {
		var filtered = [];
		angular.forEach(items, function(item) {
			if (item.category == cat) {
				filtered.push(item);
			}
		});
		return filtered;
	};
});

App.directive('toggler', function() {
	return function(scope, element) {
		var toggler = element[0];

		function toggleMenu() {
			var mainmenu = document.getElementById('mainmenu');
			if (mainmenu.className == 'showed') {
				mainmenu.className = '';
			} else {
				mainmenu.className = 'showed';
			}
		}

		if (!toggler.addEventListener) {
			toggler.attachEvent("onclick", toggleMenu);
		} else {
			toggler.addEventListener("click", toggleMenu, false);
		}
	}
});

var field_pos;

App.directive('flexmenu', function() {

	function render() {
		var w = window,
			d = document,
			e = d.documentElement,
			g = d.getElementsByTagName('body')[0],
			x = w.innerWidth || e.clientWidth || g.clientWidth,
			y = w.innerHeight || e.clientHeight || g.clientHeight;

		var begin = y / 2 - 175 - 60;
		var move = (-(900 - x) / 2) + 10;

		document.getElementById('box-parent').style.marginTop = (begin < 0 ? 0 : begin) + 'px';
		document.getElementById('box-holder').style.marginLeft = (move < 0 ? move : 0) + 'px';
		field_pos = parseInt(move < 0 ? move : 0);
	}

	return function(scope, element, attrs) {
		render();
		window.onresize = render;
	}
});

App.directive('carousel', function() {

	var calculate = function(p, firstNum, diff, back) {
		return Math.sin(p / 100 * Math.PI / 2) * diff * (!back ? -1 : 1) + firstNum;
	};

	var interval;
	var flag = true;

	var move = function(element, parent) {
		var percentage = 0;
		flag = !flag;
		var start = flag ? -870 : 0;

		var before = new Date();

		var interval = setInterval(function() {
			now = new Date();
			var elapsedTime = (now.getTime() - before.getTime());
			percentage++;

			if (percentage >= 100) {
				clearInterval(interval);
			}

			if (elapsedTime > 50) {
				element.style.marginLeft = field_pos + 'px';
				flag = true;
				clearInterval(interval);
			} else {
				element.style.marginLeft = field_pos + calculate(percentage, start, 870, start != 0) + 'px';
			}

			
			before = new Date();
		}, 10);
	}

	return function(scope, elem) {
		clearInterval(interval);

		var loop = setInterval(function() {
			move(document.getElementById('box-holder'), document.getElementById('box-parent').offsetWidth);
		}, 3000);

		scope.$on('$destroy', function() {
			console.log("destroy");
			clearInterval(loop);
			clearInterval(interval);
		});
	}
});

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

		API.getHomeItems(6, function(data) {
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