var App = angular.module('Fobos', ['ngRoute']);

App.config(function($routeProvider, $locationProvider) {
	$routeProvider
		.when('/', {
			templateUrl: 'partials/home.html'
		})
		.when('/contacts', {
			templateUrl: 'partials/contacts.html'
		})
		.when('/about', {
			templateUrl: 'partials/about.html'
		})
		.when('/interesting', {
			templateUrl: 'partials/interesting.html'
		})
		.when('/products', {
			templateUrl: 'partials/products.html'
		})
		.otherwise({
			redirectTo: '/'
		});


	$locationProvider.html5Mode(true);
});