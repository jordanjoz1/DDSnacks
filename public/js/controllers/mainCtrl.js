// public/js/controllers/mainCtrl.js
angular.module('mainCtrl', [])

    // inject the Snack service into our controller
    .controller('mainController', function($scope, $http, Snack) {
        // object to hold all the data for the new snack form
        $scope.snackData = {};

        // loading variable to show the spinning loading icon
        $scope.loading = true;

        // get all the snacks first and bind it to the $scope.snacks object
        // use the function we created in our service
        // GET ALL SNACKS ====================================================
        Snack.get()
            .success(function(data) {
                $scope.snacks = data.snacks;
                $scope.loading = false;
            });

        // function to handle submitting the form
        // SAVE A SNACK ======================================================
        $scope.submitSnack = function() {

            $scope.loading = true;

            // save the snack. pass in snack data from the form
            // use the function we created in our service
            Snack.save($scope.snackData)
                .success(function(data) {

                    // if successful, we'll need to refresh the snack list
                    Snack.get()
                        .success(function(data) {
                            $scope.snacks = data.snacks;
                            $scope.loading = false;
                        });

                })
                .error(function(data) {
                    console.log(data);
                });


            // clear input
            $scope.snackData.name = null;
        };

    });