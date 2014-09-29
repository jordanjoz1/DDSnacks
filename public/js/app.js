// public/js/app.js
var snackApp = angular.module('snackApp', ['mainCtrl', 'snackService', 'voteService', 'groupService', 'commentService']);

$(function() {
    $('#snack-input').maxlength();
});