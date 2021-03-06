// public/js/services/snackService.js
angular.module('voteService', [])

    .factory('Vote', function($http) {

        return {
            // save a vote
            save : function(voteData) {
                return $http({
                    method: 'POST',
                    url: 'index.php/api/v1/vote',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(voteData)
                });
            }
        }
    });