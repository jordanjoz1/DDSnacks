// public/js/services/snackService.js
angular.module('snackService', [])

    .factory('Snack', function($http) {

        return {
            // get all the snacks
            get : function() {
                return $http.get('index.php/api/v1/snack');
            },

            // save a snack (pass in snack data)
            save : function(snackData) {
                return $http({
                    method: 'POST',
                    url: 'index.php/api/v1/snack',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(snackData)
                });
            }
        }

    });