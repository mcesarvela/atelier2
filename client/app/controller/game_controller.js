angular.module('app').controller('GameController', ['$scope', '$http', 'GameFactory',
    function($scope, $http, GameController){

    $scope.game = {};

    $scope.start = function (pseudo, level) {
        GameFactory.play({"pseudo" : pseudo, "level": level}).then(function (response) {

        }, function (error) {

        });
    };

    $scope.pauseOrResume = function () {
        if($scope.game.isPlaying){
            $scope.game.isPlaying = false;
            localStorage.setItem("findYourWay", JSON.stringify($scope.game));
        }else{
            var game = JSON.parse(localStorage.getItem("findYourWay"));
            if(game)    {
                $scope.game = game;
                $scope.game.isPlaying = true;
                localStorage.removeItem("findYourWay");
            }
        }
    };

    $scope.finishGame = function () {

    };

    angular.extend($scope, {
	  markers: {},            
	  europeanPaths: {}, 
	  events: {
            map: {
                enable: ['click', 'drag', 'blur', 'touchstart', 'moveend'],
                logic: 'emit'
            }
      },
	  cen: {
		lat: 47.282448,
		lng: 1.883957,
		zoom: 6
	  }			  
	});	
    

    $scope.$on('leafletDirectiveMap.click', function(event,args){
        $scope.clicked_lat = args.leafletEvent.latlng.lat;
        $scope.clicked_lng = args.leafletEvent.latlng.lng;

        console.log(distance($scope.clicked_lat,49.28214015975995, $scope.clicked_lng, 3.438720703125))
    });

  

		

}]);
