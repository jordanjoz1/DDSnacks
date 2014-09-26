<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DD Snacks</title>

    <!-- CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <!-- load bootstrap via cdn -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <!-- load fontawesome -->
    <link rel="stylesheet" href="css/styles.css">
    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:700);
    </style>

    <!-- JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script>

    <!-- ANGULAR -->
    <script src="js/controllers/mainCtrl.js"></script>
    <script src="js/services/snackService.js"></script>
    <script src="js/services/voteService.js"></script>
    <script src="js/services/groupService.js"></script>
    <script src="js/app.js"></script>
</head>
<body class="container" data-ng-app="snackApp" data-ng-controller="mainController">
<div data-ng-controller="groupController">
    <div class="col-md-8 col-md-offset-2">

        <!-- PAGE TITLE =============================================== -->
        <div class="page-header">
            <h2>DD Snacks</h2>
        </div>

        <!-- LOADING ICON =============================================== -->
        <!-- show loading icon if the loading variable is set to true -->
        <p class="text-center" data-ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

        <!-- NEW SNACK FORM =============================================== -->
        <form data-ng-submit="submitSnack()" data-ng-hide="loading">
            <!-- ng-submit will disable the default form action and use our function -->
            <!-- ROOM FILTER =============================================== -->
            <select class="form-control" data-ng-model="selected.group"
                    data-ng-options="group.name for group in groups"></select>
            <br/>
            <div class="entry input-group">
                <input type="text" class="form-control input-lg" name="snack" data-ng-model="snackData.name"
                       placeholder="Search or add a new snack"/>
            <span class="input-group-btn">
                <button class="btn btn-success btn-add btn-lg" type="submit">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </span>
            </div>
            <br/>
            <div class="btn-group btn-group-sm btn-group-justified" data-toggle="buttons">
                <label class="btn btn-default active" ng-click="predicate = 'sum_votes'; reverse=true">
                    <input type="radio" name="options" id="option1" checked>Popular
                </label>
                <label class="btn btn-default" ng-click="predicate = controversySort; reverse=true">
                    <input type="radio" name="options" id="option2">Controversial
                </label>
            </div>
        </form>



        <!-- THE SNACKS =============================================== -->
        <!-- hide these cnacks if the loading variable is true -->
        <div class="snack-list-item" data-ng-hide="loading"
             data-ng-repeat="snack in snacks | filter:snackData.name | filter:{group_id:selected.group.id} | orderBy: predicate:reverse"
             data-ng-controller="voteController">
            <div class="arrow-container">
                <div data-ng-class="snack.vote_value == -1 ? 'arrow-down selected' : 'arrow-down'"
                     data-ng-click="vote(snack.id, -1)"></div>
                <div class="arrow-value">-{{ snack.downvotes }}</div>
            </div>
            <div class="snack-list-item-text-container">
                <div data-ng-class="snack-list-item-text">{{ snack.name }} ({{ snack.sum_votes }})
                </div>
            </div>
            <div class="arrow-container">
                <div data-ng-class="snack.vote_value == 1 ? 'arrow-up selected' : 'arrow-up'"
                     data-ng-click="vote(snack.id, 1)"></div>
                <div class="arrow-value">+{{ snack.upvotes }}</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>