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
					templateUrl: '/partials/products.html'
				})
				.state("interesting", {
					url: "/interesting",
					templateUrl: '/partials/interesting.html',
					controller: 'InterestCtrl'
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