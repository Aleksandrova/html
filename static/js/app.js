var App = angular.module('Fobos', ['ngResource', 'ui.router', 'ngAnimate']);

App.config(
	['$stateProvider', '$urlRouterProvider', '$locationProvider',
		function($stateProvider, $urlRouterProvider, $locationProvider) {

			$urlRouterProvider
				.when('/products', '/products/cat/kuhnenski-rolki');

			$stateProvider
				.state("home", {
					url: "/",
					templateUrl: '/partials/home.html',
					title: 'Начало'
				})
				.state("products", {
					url: "/products",
					templateUrl: '/partials/products.html',
					controller: 'ProductCtrl',
					title: 'Продукти'
				})
				.state("products.category", {
					url: "/cat/:id",
					controller: 'CategoryCtrl',
					templateUrl: '/partials/products.template.html',
					title: 'Продукти'
				})
				.state("products.view", {
					url: "/:id",
					controller: 'ViewProductCtrl',
					templateUrl: '/partials/products.single.html',
					title: 'Продукти'
				})
				.state("interesting", {
					url: "/interesting",
					templateUrl: '/partials/interesting.html',
					controller: 'InterestCtrl',
					title: 'Интерестно'
				})
				.state("interesting.page", {
					url: "/:id",
					controller: ['$rootScope', '$stateParams',
						function($rootScope, $stateParams) {
							$rootScope.$emit('articleid', $stateParams.id)
						}
					],
					title: 'Интерестно'
				})
				.state('about', {
					url: '/about',
					templateUrl: '/partials/about.html',
					title: 'За нас'
				})
				.state('contacts', {
					url: '/contacts',
					templateUrl: '/partials/contacts.html',
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
		return {
			getInteresting: function() {
				return $resource('/api/interesting.json');
			},
			getProducts: function() {
				return $resource('/api/products.json');
			}
		}
	}
]);

App.filter('dots', function() {
	return function(input) {
		input = input.substr(0, 80) + '..';
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
		var rightMenu = document.getElementById('mainmenu');
		element[0].addEventListener('click', function() {
			if (rightMenu.className == 'showed') {
				rightMenu.className = '';
			} else {
				rightMenu.className = 'showed';
			}
		}, false);
	}
});