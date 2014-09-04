// public/js/services/snackService.js
angular.module('voteService', [])

    .factory('Vote', function($http) {

        return {
            // save a vote
            save : function(snackData) {
                return $http({
                    method: 'POST',
                    url: 'index.php/api/v1/vote',
                    data: snackData
                });
            }
        }

    });