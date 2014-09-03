// public/js/controllers/mainCtrl.js
angular.module('mainCtrl', [])

    // inject the Comment service into our controller
    .controller('mainController', function($scope, $http, Comment) {
        // object to hold all the data for the new comment form
        $scope.commentData = {};

        // loading variable to show the spinning loading icon
        $scope.loading = true;

        // get all the comments first and bind it to the $scope.comments object
        // use the function we created in our service
        // GET ALL COMMENTS ====================================================
        Comment.get()
            .success(function(data) {
                console.log(data.snacks);
                $scope.snacks = data.snacks;
                $scope.loading = false;
            });

        // function to handle submitting the form
        // SAVE A COMMENT ======================================================
        $scope.submitComment = function() {
            $scope.loading = true;

            // save the comment. pass in comment data from the form
            // use the function we created in our service
            Comment.save($scope.commentData)
                .success(function(data) {

                    // if successful, we'll need to refresh the comment list
                    Comment.get()
                        .success(function(getData) {
                            $scope.comments = getData;
                            $scope.loading = false;
                        });

                })
                .error(function(data) {
                    console.log(data);
                });
        };

        // function to handle deleting a comment
        // DELETE A COMMENT ====================================================
        $scope.deleteComment = function(id) {
            $scope.loading = true;

            // use the function we created in our service
            Comment.destroy(id)
                .success(function(data) {

                    // if successful, we'll need to refresh the comment list
                    Comment.get()
                        .success(function(getData) {
                            $scope.comments = getData;
                            $scope.loading = false;
                        });

                });
        };

    });