// public/js/app.js
var snackApp = angular.module('snackApp', ['mainCtrl', 'snackService', 'voteService', 'groupService']);

$(function() {
    $('#snack-input').maxlength();
});