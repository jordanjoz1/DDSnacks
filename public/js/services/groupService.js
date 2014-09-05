// public/js/services/groupService.js
angular.module('groupService', [])

    .factory('Group', function($http) {

        return {
            // get all the groups
            get : function() {
                return $http.get('index.php/api/v1/group');
            }
        }

    });