<!-- app/views/index.php -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DD Snacks</title>

    <!-- CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> <!-- load bootstrap via cdn -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> <!-- load fontawesome -->
    <link rel="stylesheet" href="css/styles.css">
    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:700);
    </style>

    <!-- JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->

    <!-- ANGULAR -->
    <!-- all angular resources will be loaded from the /public folder -->
    <script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->
    <script src="js/services/snackService.js"></script> <!-- load our service -->
    <script src="js/services/voteService.js"></script> <!-- load our service -->
    <script src="js/services/groupService.js"></script> <!-- load our service -->
    <script src="js/app.js"></script> <!-- load our application -->
</head>
<!-- declare our angular app and controller -->
<body class="container" ng-app="snackApp" ng-controller="mainController">
<div ng-controller="groupController"">
<div class="col-md-8 col-md-offset-2">

    <!-- PAGE TITLE =============================================== -->
    <div class="page-header">
        <h2>DD Snacks</h2>
    </div>

    <!-- NEW SNACK FORM =============================================== -->
    <form ng-submit="submitSnack()" ng-hide="loading" > <!-- ng-submit will disable the default form action and use our function -->
        <!-- ROOM FILTER =============================================== -->
        <select class="form-control" ng-model="selected.group" ng-options="group.name for group in groups"></select>
        </br>
        <div class="entry input-group">
            <input type="text" class="form-control input-lg" name="snack" ng-model="snackData.name" placeholder="Search or add a new snacky"/>
            <span class="input-group-btn">
                <button class="btn btn-success btn-add btn-lg" type="submit">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </span>
        </div>
    </form>

    <!-- LOADING ICON =============================================== -->
    <!-- show loading icon if the loading variable is set to true -->
    <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

    <!-- THE SNACKS =============================================== -->
    <!-- hide these cnacks if the loading variable is true -->
    <div class="snack-list-item" ng-hide="loading" ng-repeat="snack in snacks | filter:snackData.name | filter:{group_id:selected.group.id} | orderBy: 'sum_votes':true"  ng-controller="voteController">
        <div class="arrow-container">
            <div ng-class="snack.vote_value == -1 ? 'arrow-down selected' : 'arrow-down'" ng-click="vote(snack.id, -1)"></div>
            <div class="arrow-value">-{{ snack.downvotes }}</div>
        </div>
        <div class="snack-list-item-text-container">
            <div ng-class="snack-list-item-text">{{ snack.name }} ({{ snack.sum_votes }})
            </div>
        </div>
        <div class="arrow-container"">
            <div ng-class="snack.vote_value == 1 ? 'arrow-up selected' : 'arrow-up'" ng-click="vote(snack.id, 1)"></div>
            <div class="arrow-value">+{{ snack.upvotes }}</div>
        </div>
    </div>
</div>
</div>
</body>
</html>