// public/js/controllers/mainCtrl.js
angular.module('mainCtrl', [])

    // inject the Snack service into our controller
    .controller('mainController', function($scope, $http, Snack) {
        // object to hold selected group
        $scope.selected = {};

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

            // set group id
            $scope.snackData.group_id = $scope.selected.group.id;

            // save the snack. pass in snack data from the form
            // use the function we created in our service
            Snack.save($scope.snackData)
                .success(function(data) {
                    // add snack to list
                    snack = data.snack;
                    console.log(snack);
                    snack.sum_votes = snack.upvotes - snack.downvotes;
                    snack.vote_value = 0;
                    $scope.snacks.push(snack);

                })
                .error(function(data) {
                    console.log(data);
                });


            // clear input
            $scope.snackData.name = null;
        }
    })
    // inject the Vote service into our controller
    .controller('voteController', function($scope, $http, Vote) {

        $scope.vote = function(snackId, value) {

            Vote.save({id: snackId, value: value})
                .success(function(data) {
                    if (!data.error) {
                        for (index = 0; index < $scope.snacks.length; index++ ){
                            if ($scope.snacks[index].id == data.snack.id) {
                                snack = data.snack;
                                snack.sum_votes = snack.upvotes - snack.downvotes;
                                snack.vote_value = value;
                                $scope.snacks[index] = snack;
                            }
                        }
                    }
                })
                .error(function(data) {
                    console.log(data);
                });
        }

    })

    // inject the Group service into our controller
    .controller('groupController', function($scope, $http, Group) {

        Group.get()
            .success(function(data) {
                $scope.groups = data.groups;
            });

    });