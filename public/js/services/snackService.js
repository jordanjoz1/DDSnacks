// public/js/services/snackService.js
angular.module('snackService', [])

    .factory('Snack', function($http) {

        return {

            // get all snacks for or snacks for an individual group
            get : function(id) {
                if (id == null) {
                    return $http.get('../../index.php/api/v1/snack');
                } else {
                    return $http({
                        url: '../../index.php/api/v1/snack',
                        method: "GET",
                        params: {group: id}
                    });
                }
            },

            // save a snack (pass in snack data)
            save : function(snackData) {
                return $http({
                    method: 'POST',
                    url: '../../index.php/api/v1/snack',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(snackData)
                });
            }
        }

    });