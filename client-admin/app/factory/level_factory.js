angular.module('backoffice').factory('LevelFactory', ['$http', 'API_URL',function ($http, API_URL) {
    var config = {headers: {'Authorization': 'Token token=61813703d88b45b48653a1cd3f5673d6',
        'Content-Type': 'application/json'}};

    return {
        all:function () {
            return $http.get(API_URL+'levels');
        }
    }

}]);