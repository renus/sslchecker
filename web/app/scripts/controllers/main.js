'use strict';

/**
 * @ngdoc function
 * @name webApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the webApp
 */
angular.module('webApp')
    .controller('MainCtrl', function ($scope, RequestService, ngDialog) {

        $scope.my = {'domain' : ""};

        RequestService.send(list_domain, {})
            .then(
                function($data) {
                    $scope.domains = $data.data;
                },
                function() {

                }
            );



        $scope.add = function() {

            var domain = angular.isDefined($scope.my.domain) ? $scope.my.domain : '';

            RequestService.send(add_domain, {'domain': 'https://' + domain})
            .then(
                function(response) {

                    if (response.data.status != 'success') {
                        ngDialog.open({
                            className: 'ngdialog-theme-default',
                            template: '/app/views/invalid.html'
                        });
                    } else {
                        $scope.domains.push(response.data.response);
                    }
                },
                function() {
                }
            );
        }

    });
