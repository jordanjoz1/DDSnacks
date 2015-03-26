// public/js/app.js
var snackApp = angular.module('snackApp', ['mainCtrl', 'snackService', 'voteService', 'groupService',
    'commentService', 'loginService', 'ngSanitize']);

$(function() {
    $('#snack-input').maxlength();
});