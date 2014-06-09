var App = angular.module('Fobos', ['ngResource', 'ui.router', 'ngAnimate']);
var path = '/new';

App.config(
	['$stateProvider', '$urlRouterProvider', '$locationProvider', '$sceProvider',
		function($stateProvider, $urlRouterProvider, $locationProvider, $sceProvider) {
			$sceProvider.enabled(false);

			//$urlRouterProvider
			//	.when('/new/interesting', '/new/interesting/znaehte-li')
			//	.when('/new/products', '/new/products/cat/kuhnenski-rolki');

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
					url: "/new/cat/:id",
					controller: 'CategoryCtrl',
					templateUrl: path + '/partials/products.template.html',
					title: 'Продукти'
				})
				.state("products.view", {
					url: "/new/:id",
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
					url: "/new/:id",
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
					for (var i = 0; i < count; i++) {
						output.push(res[randomId(res.length)]);
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
	}

	return function(scope, element, attrs) {
		render();
		window.onresize = render;
	}
});