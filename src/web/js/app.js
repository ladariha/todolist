'use strict';



var todolist_module = angular.module('todolist', ['ui'])

        .config(function($provide, $routeProvider) {


    $provide.factory('utils', function() {
        var u = {};
        u.escape = function(s) {
            return encodeURIComponent(s);
        };
        return u;
    });

    $routeProvider.when('/list/:id/create', {templateUrl: 'partials/todo_new.html', controller: TodoCtrl});
    $routeProvider.when('/list/:id/edit', {templateUrl: 'partials/todo_edit.html', controller: TodoCtrl});
    $routeProvider.when('/list/:id', {templateUrl: 'partials/todolist.html', controller: TodoCtrl});
    $routeProvider.when('/', {templateUrl: 'partials/home.html', controller: HomeCtrl});
    $routeProvider.otherwise({redirectTo: '/'});

});
