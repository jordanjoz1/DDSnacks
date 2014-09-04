<!-- app/views/index.php -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DD Snacks</title>

    <!-- CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> <!-- load bootstrap via cdn -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> <!-- load fontawesome -->
    <style>
        body 		{ padding-top:30px; }
        form 		{ padding-bottom:20px; }
    </style>

    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:700);

        body {
            margin: 0;
            font-family: 'Lato', sans-serif;
            text-align: center;
            color: #999;
        }

        .welcome {
            width: 300px;
            height: 200px;
            position: absolute;
            left: 50%;
            top: 20%;
            margin-left: -150px;
            margin-top: -100px;
        }

        a, a:visited {
            text-decoration: none;
        }

        h1 {
            font-size: 32px;
            margin: 16px 0 16px 0;
        }

        /***FIRST STYLE THE BUTTON***/
        input#add-new-button {
            border: 2px groove #7c93ba;
            cursor: pointer; /*forces the cursor to change to a hand when the button is hovered*/
            padding: 0 20px;
            /*give the background a gradient - see cssdemos.tupence.co.uk/gradients.htm for more info*/
            background-color: #6b6dbb; /*required for browsers that don't support gradients*/
            /*style to the text inside the button*/
            font-family: Andika, Arial, sans-serif; /*Andkia is available at http://www.google.com/webfonts/specimen/Andika*/
            color: #fff;
            font-size: 1.1em;
            letter-spacing: .1em;
            font-variant: small-caps;
            /*give the corners a small curve*/
            -webkit-border-radius: 0 15px 15px 0;
            -moz-border-radius: 0 15px 15px 0;
            border-radius: 0 15px 15px 0;
            /*add a drop shadow to the button*/
            -webkit-box-shadow: rgba(0, 0, 0, .75) 0 2px 6px;
            -moz-box-shadow: rgba(0, 0, 0, .75) 0 2px 6px;
            box-shadow: rgba(0, 0, 0, .75) 0 2px 6px;
        }

        /***NOW STYLE THE BUTTON'S HOVER AND FOCUS STATES***/
        input#add-new-button:hover, input#add-new-button:focus {
            color: #edebda;
            /*reduce the spread of the shadow to give a pushed effect*/
            -webkit-box-shadow: rgba(0, 0, 0, .25) 0 1px 0;
            -moz-box-shadow: rgba(0, 0, 0, .25) 0 1px 0;
            box-shadow: rgba(0, 0, 0, .25) 0 1px 0;
        }

        .add-new-form input, .add-new-form textarea {
            padding: 1px 1px 1px 8px;
            height: 30px;
            border: 1px solid #aaa;
            box-shadow: 0 0 3px #ccc, 0 10px 15px #eee inset;
            border-radius: 2px;
        }

        .add-new-form input:focus, .add-new-form textarea:focus {
            background: #fff;
            border: 1px solid #555;
            box-shadow: 0 0 3px #aaa;
        }

        #list-snacks {
            margin-top: 16px;
        }

        .snack-list-item {
            padding: 8px;
            padding-bottom: 12px;
            padding-top: 12px;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid #aaa;;
        }

        .arrow-up {
            height: 0;
            width: 20px;
            margin: auto;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-bottom: 20px solid;
            border-bottom-color: lightgray;
        }

        .arrow-up.selected {
            border-bottom-color: green;
        }

        .arrow-up:hover, .arrow-up:focus {
            border-bottom-color: lightgreen;
        }

        .arrow-down {
            height: 0;
            width: 20px;
            margin: auto;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 20px solid;
            border-top-color: lightgray;
        }

        .arrow-down.selected {
            border-top-color: red;
        }

        .arrow-down:hover, .arrow-down:focus {
            border-top-color: lightpink;
        }

        .snack-list-item_text {
            display: inline-block;
            *display: inline;
            zoom: 1;
        }

        .arrow-container {
            display: inline-block;
            position: relative;
            width: 15%%;
        }

        .arrow-value {
        }

        .snack-list-item-text-container {
            position: relative;
            width: 60%;
            display: inline-block;
            vertical-align: top;
            margin-top: 8px;
        }
        ul {
            padding: 0;
            list-style-type: none;
        }
    </style>

    <!-- JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->

    <!-- ANGULAR -->
    <!-- all angular resources will be loaded from the /public folder -->
    <script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->
    <script src="js/services/snackService.js"></script> <!-- load our service -->
    <script src="js/services/voteService.js"></script> <!-- load our service -->
    <script src="js/app.js"></script> <!-- load our application -->

</head>
<!-- declare our angular app and controller -->
<body class="container" ng-app="snackApp" ng-controller="mainController">
<div class="col-md-8 col-md-offset-2">

    <!-- PAGE TITLE =============================================== -->
    <div class="page-header">
        <h2>DD Snacks</h2>
    </div>

    <!-- NEW SNACK FORM =============================================== -->
    <form ng-submit="submitSnack()"> <!-- ng-submit will disable the default form action and use our function -->
        <div class="entry input-group">
            <input type="text" class="form-control input-lg" name="snack" ng-model="snackData.name" placeholder="Search or add a new snacky">
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
    <div class="snack-list-item" ng-hide="loading" ng-repeat="snack in snacks | filter:snackData.name"">
        <div class="arrow-container">
            <div ng-class="snack.vote_value == -1 ? 'arrow-down selected' : 'arrow-down'" ng-click="vote(snack.id, -1)"></div>
            <div class="arrow-value">-{{ snack.downvotes }}</div>
        </div>
        <div class="snack-list-item-text-container">
            <div class="snack-list-item_text name">{{ snack.name }} ({{ snack.sum_votes }})
            </div>
        </div>
        <div class="arrow-container"">
            <div ng-class="snack.vote_value == 1 ? 'arrow-up selected' : 'arrow-up'" ng-click="vote(snack.id, 1)"></div>
            <div class="arrow-value">+{{ snack.upvotes }}</div>
        </div>
    </div>
</div>
</body>
</html>