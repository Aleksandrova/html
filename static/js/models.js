App.factory('API', ['$resource',
	function($resource) {
		return {
			getAllInteresting: function() {
				return $resource('/api/interesting.json');
			}
		}
	}
]);

App.filter('dots', function(){
	return function(input) {
		input = input.substr(0, 80) + '..';
		return input;
	}
});