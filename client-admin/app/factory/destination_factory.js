angular.module('backoffice').factory('DestinationFactory', ['$http','API_URL',function ($http, API_URL) {
    var url = API_URL + 'destinations';
    return {
        all:function () {
            return $http.get(url);
        },
        update: function (id, json) {
            return $http.put(url+'/'+id, json);
        },
        allHints: function (id) {
            return $http.get(url+'/'+id+'/hints');
        },
        add: function (json) {
            return $http.post(url, json);
        },
        addHint : function (id, json) {
            return $http.post(url+'/'+id+'/hints', json);
        },
        deleteHint : function(id_destination, id_hint){
            return $http.delete(url+'/'+id_destination+'/hints/'+id_hint);
        }
    }

}]);