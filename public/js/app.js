// public/js/app.js
var snackApp = angular.module('snackApp', ['mainCtrl', 'snackService', 'voteService', 'groupService', 'commentService', 'ngSanitize']);

$(function() {
    $('#snack-input').maxlength();
});