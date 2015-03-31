// public/js/controllers/mainCtrl.js
angular.module('mainCtrl', ['ngRoute'])

    // inject the Snack service into our controller
    .controller('mainController', function($scope, $http, $location, $anchorScroll, $routeParams, Snack, User, Group) {

        // sort by controvery rating
        $scope.Math = window.Math;
        $scope.controversySort = function(snack) {
            if (snack.upvotes <= 0 || snack.downvotes <=0) {
                return 0;
            }
            // maximize total votes relative to difference in points, and adjust slightly for total votes
            // this seems better for a smaller number of votes
            total = parseInt(snack.upvotes) + parseInt(snack.downvotes);
            return ((total + 1) / (Math.abs(snack.upvotes - snack.downvotes) + 1)) * Math.sqrt(total);
        };
        // alternative Reddit algorithm
        $scope.redditControversySort = function(snack) {
            if (snack.upvotes <= 0 || snack.downvotes <=0) {
                return 0;
            }
            // maximize for number of votes and a close ratio between the number of upvotes and downvotes
            return (parseInt(snack.upvotes) + parseInt(snack.downvotes)) / (Math.max(snack.upvotes, snack.downvotes) / Math.min(snack.upvotes, snack.downvotes));
        }

        $scope.timeSince = function timeSince(date) {

            date = Date.parse(date + " GMT");

            var seconds = Math.floor((new Date() - date) / 1000);

            var interval = Math.floor(seconds / 31536000);

            if (interval >= 1) {
                return interval + "y";
            }
            interval = Math.floor(seconds / 2592000);
            if (interval >= 1) {
                return interval + "mon";
            }
            interval = Math.floor(seconds / 86400);
            if (interval >= 1) {
                return interval + "d";
            }
            interval = Math.floor(seconds / 3600);
            if (interval >= 1) {
                return interval + "h";
            }
            interval = Math.floor(seconds / 60);
            if (interval >= 1) {
                return interval + "m";
            }
            interval = Math.floor(seconds);
            if (interval < 0) {
                interval = 0;
            }
            return interval + "s";
        };

        // set default sort values
        $scope.predicate = 'sum_votes';
        $scope.reverse = true;

        // object to hold selected group
        $scope.selected = {};

        // object to hold all the data for the new snack form
        $scope.snackData = {};

        // loading variable to show the spinning loading icon
        $scope.loading = true;

        // get group id from path
        var path = $location.path().split("/");
        var groupId = path.pop();
        var pathType = path.pop();
        var attemptLogin = true;
        // not an individual group page
        if (pathType != "g") {
            attemptLogin = false;
            groupId = null;
        }
        // all group hack
        if (pathType == "g" && groupId == "all") {
            attemptLogin = true;
            groupId = null;
        }

        var loadData = function() {
            // get all the snacks first and bind it to the $scope.snacks object
            // use the function we created in our service
            // GET ALL SNACKS ====================================================
            Snack.get(groupId)
                .success(function(data) {
                    // calculate sum of votes
                    for (var i in data.snacks) {
                        data.snacks[i].sum_votes = data.snacks[i].upvotes - data.snacks[i].downvotes;
                    }
                    $scope.snacks = data.snacks;
                    $scope.loading = false;
                });

            Group.get(groupId)
                .success(function(data) {
                    $scope.groups = data.groups;
                    // automatically select the first group
                    $scope.selected.group = data.groups[0];
                });
        };

        // use pride login for specific groups
        if (attemptLogin) {
            DD.Events.onReady(function() {
                DD.Events.getCurrentUserAsync(function (user) {
                    var newUser = new Object();
                    newUser.userId = user.UserId;
                    newUser.firstName = user.FirstName;
                    newUser.lastName = user.LastName;
                    User.save(newUser)
                        .success(function (data) {
                            // check for failure
                            if (data.error) {
                                alert(data.message);
                                return;
                            }
                            loadData();
                        })
                });
            });
        } else {
            loadData()
        }

        // function to handle submitting the form
        // SAVE A SNACK ======================================================
        $scope.submitSnack = function() {

            // don't do anything if group is not editable
            if ($scope.selected.group.editable == 0) {
                return;
            }
        
            // set group id
            $scope.snackData.group_id = $scope.selected.group.id;

            // save the snack. pass in snack data from the form
            // use the function we created in our service
            Snack.save($scope.snackData)
                .success(function(data) {
                    // add snack to list
                    snack = data.snack;
                    snack.sum_votes = snack.upvotes - snack.downvotes;
                    snack.vote_value = 0;
                    snack.comments = [];
                    $scope.snacks.push(snack);

                    // scroll snack into view
                    //$location.hash('snack-' + snack.id);
                    //$anchorScroll();
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
                                // only update vote values
                                $scope.snacks[index].sum_votes = snack.upvotes - snack.downvotes;
                                $scope.snacks[index].vote_value = value;
                                $scope.snacks[index].upvotes = snack.upvotes;
                                $scope.snacks[index].downvotes = snack.downvotes;
                                break;
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
    .controller('groupController', function($scope, $http, $location, Group) {
        // make architecture better
    })

    // inject the comment service into our controller
    .controller('commentController', function($scope, $http, Comment) {

        $scope.submitComment = function (snackId) {

            // save the snack. pass in snack data from the form
            // use the function we created in our service
            Comment.save({id: snackId, comment: $scope.commentText})
                .success(function (data) {
                    if (!data.error) {
                        // add to snack's comments
                        for (index = 0; index < $scope.snacks.length; index++) {
                            if ($scope.snacks[index].id == data.comment.snack_id) {
                                $scope.snacks[index].comments.push(data.comment);
                                break;
                            }
                        }
                    }
                })
                .error(function (data) {
                    console.log(data);
                });


            // clear input
            $scope.commentText = null;
        }
    })

    .config(function ($routeProvider, $locationProvider) {
        $routeProvider
            .when('/index.php/g/:groupId', {
                controller: 'MainController'
            });

        // configure html5 to get links working on jsfiddle
        $locationProvider.html5Mode(true);


    });