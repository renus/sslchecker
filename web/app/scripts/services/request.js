angular.module('webApp')
    .service('RequestService', ['$http','$q', function($http, $q) {
        return {

            send: function(url, data) {

                var deferred = $q.defer();
                $http({
                    method: 'POST',
                    url: url,
                    data: $.param(data),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    deferred.resolve(response);
                }, function errorCallback(response) {
                    deferred.reject();
                });
                return deferred.promise;
            }

        }
    }]);