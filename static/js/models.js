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