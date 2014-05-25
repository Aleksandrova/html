App.controller('InterestCtrl', ['$scope', 'API', '$location', '$stateParams', '$rootScope',
	function($scope, API, $location, $stateParams, $rootScope) {
		$scope.articles = API.getAllInteresting().query();
		$scope.current = {};

		var ignoreDefault = false;

		$scope.goTo = function(url) {
			for (var i in $scope.articles) {
				if ($scope.articles[i].url == url) {
					$scope.current = $scope.articles[i];
					$location.path('/interesting/' + url).replace();
					return;
				}
			}

			$scope.current = $scope.articles[0];
		};

		$rootScope.$on("articleid", function(event, id) {
			if ($scope.articles.$resolved) {
				$scope.goTo(id);
			} else {
				$scope.articles.$promise.then(function() {
					$scope.goTo(id);
					ignoreDefault = true;
				});
			}
		});

		$scope.$watch(function() {
			return $scope.articles[0];
		}, function() {
			if (!$scope.articles.$resolved || ignoreDefault)
				return;

			$scope.current = $scope.articles[0];
		});
	}
]);