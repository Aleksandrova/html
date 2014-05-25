App.controller('InterestCtrl', ['$scope', 'API', '$location',
	function($scope, API, $location) {
		$scope.articles = API.getAllInteresting().query();
		$scope.current = {};

		$scope.open = function(url) {
			$location.path('/interesting/' + url);
		};

		$scope.$watch(function() {
			return $scope.articles[0];
		}, function() {
			if (!$scope.articles.$resolved)
				return;

			$scope.current = $scope.articles[0];
		});

	}
]);