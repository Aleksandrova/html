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

/* Animate Directive */

App.directive('homeAnimation', function() {

	var process = function() {
		var leftNodes = document.querySelectorAll('.left-box');
		var left = leftNodes[leftNodes.length - 1];

		var current = document.querySelector('.current-box');

		var right = document.querySelector('.right-box');

		left.setAttribute('class', 'box left-box toleft');
		current.setAttribute('class', 'box toright');

		setTimeout(function() {
			left.setAttribute('class', 'box current-box');
			current.setAttribute('class', 'box right-box')
		}, 2000);

		right.setAttribute('class', 'box right-box fadeOut');

		setTimeout(function() {
			var lefts = document.querySelectorAll('.left-box');
			leftNodes[lefts.length - 2].setAttribute('class', 'box left-box bringtofront');

			right.parentNode.insertBefore(right,right.parentNode.firstChild);
			right.setAttribute('class', 'box left-box');
		}, 1000);
	};

	return function(scope, element) {
		setInterval(process, 4000);
	}
});