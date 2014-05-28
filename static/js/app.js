var App = angular.module('Fobos', ['ngResource', 'ui.router']);

App.config(
	['$stateProvider', '$urlRouterProvider', '$locationProvider',
		function($stateProvider, $urlRouterProvider, $locationProvider) {


			$urlRouterProvider
				.when('/c?id', '/contacts/:id')
				.when('/user/:id', '/contacts/:id');

			$stateProvider
				.state("home", {
					url: "/",
					templateUrl: '/partials/home.html'
				})
				.state("products", {
					url: "/products",
					templateUrl: '/partials/products.html',
					controller: 'ProductCtrl'
				})
				.state("products.category", {
					url: "/cat/:id",
					controller: 'CategoryCtrl',
					templateUrl: '/partials/products.template.html'
				})
				.state("products.view", {
					url: "/:id",
					controller: 'ViewProductCtrl',
					templateUrl: '/partials/products.single.html'
				})
				.state("interesting", {
					url: "/interesting",
					templateUrl: '/partials/interesting.html',
					controller: 'InterestCtrl'
				})
				.state("interesting.page", {
					url: "/:id",
					controller: ['$rootScope', '$stateParams',
						function($rootScope, $stateParams) {
							$rootScope.$emit('articleid', $stateParams.id)
						}
					]
				})
				.state('about', {
					url: '/about',
					templateUrl: '/partials/about.html'
				})
				.state('contacts', {
					url: '/contacts',
					templateUrl: '/partials/contacts.html'
				});

			$locationProvider.html5Mode(true);
		}
	]
);