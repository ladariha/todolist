'use strict';
/* Controllers */

function TodoListCtrl($scope) {
    $scope.TODOLIST = new TodoList();
}

function HomeCtrl($scope, $http, $location) {

    $scope.lists = [];
    $scope.fetch = function() {
        // FIXME this is loaded twice on document load 

        $http.get($scope.TODOLIST.server.buildURL("todolist", {})).success(function(data) {
            $scope.lists = data;

        }).error(function(data, status, headers, config) {
            $scope.TODOLIST.modal.update("Action failed", data.toString());
            $scope.TODOLIST.modal.show();
        });
    };

    $scope.create = function() {
        var list = {
            name: $scope.newList
        };
        $http.post($scope.TODOLIST.server.buildURL("list", {}), JSON.stringify(list)).success(function(data) {
            $scope.fetch();
            $scope.newList = null;
        }).error(function(data, status, headers, config) {
            $scope.TODOLIST.modal.update("Action failed", data.toString());
            $scope.TODOLIST.modal.show();
        });
    };

    $scope.edit = function(id) {
        $scope.currentId = id;
        $("#renameModal").modal('toggle');
    };

    $scope.rename = function() {
        var list = {
            name: $scope.updatedName
        };
        $http.put($scope.TODOLIST.server.buildURL("list", {"id": $scope.currentId}), JSON.stringify(list)).success(function(data) {
            $("#renameModal").modal('toggle');
            $scope.fetch();
        }).error(function(data, status, headers, config) {
            $scope.TODOLIST.modal.update("Action failed", data.toString());
            $scope.TODOLIST.modal.show();
        });
    };

    $scope.delete = function(id) {
        $http.delete($scope.TODOLIST.server.buildURL("list", {"id": id})).success(function(data) {
            $scope.fetch();
        }).error(function(data, status, headers, config) {
            $scope.TODOLIST.modal.update("Action failed", data.toString());
            $scope.TODOLIST.modal.show();
        });
    };

    $scope.fetch();

}



function TodoCtrl($scope, $routeParams, $http, $location) {//authService
    $scope.id = $routeParams.id || -1;
    $scope.list = {};
    $scope.todo = {
        todolist_id: $routeParams.id || -1
    };
    $scope.orderProp = 'title';
    $scope.currentAction = "";
    $scope.currentActionId = -1;

    try {
        $("#start").datetimepicker();
    } catch (e) {

    }

    /**
     * Loads data from server
     */
    $scope.fetch = function() {
        $http.get($scope.TODOLIST.server.buildURL("list", {'id': $scope.id})).success(function(data) {
            window.console.log(data);
            $scope.list = data;
        }).error(function(data, status, headers, config) {
            $scope.TODOLIST.modal.update("Action failed", data.toString());
            $scope.TODOLIST.modal.show();
        });
    };

    $scope.delete = function(id) {
        $http.delete($scope.TODOLIST.server.buildURL("todo", {'id': id})).success(function(data) {
            $scope.fetch();
        }).error(function(data, status, headers, config) {
            $scope.TODOLIST.modal.update("Action failed", data.toString());
            $scope.TODOLIST.modal.show();
        });
    }

    $scope.setRoute = function(route, param) {
        $location.path(route + "/" + param);
    };

    $scope.finish = function(id) {
        for (var i = 0; i < $scope.list.todos.length; i++) {
            window.console.log(parseInt($scope.list.todos[i].id) + "_" + parseInt(id));
            if (parseInt($scope.list.todos[i].id) === parseInt(id)) {
                if ($scope.list.todos[i].state === "finished")
                    $scope.list.todos[i].state = "inProgress";
                else
                    $scope.list.todos[i].state = "finished";
                $http.put($scope.TODOLIST.server.buildURL("todo", {"id": id}), JSON.stringify($scope.list.todos[i]))
                        .success(function(data, status) {
                    //         $scope.TODOLIST.modal.update("Todo updated", "");
                    //       $scope.TODOLIST.modal.show();
                    $scope.fetch();
                }).error(function(data, status, headers, config) {
                    $scope.TODOLIST.modal.update("Action failed", data.toString());
                    $scope.TODOLIST.modal.show();
                });
            }
        }
    };

    $scope.create = function() {
        $scope.setRoute("/list/" + $scope.id, "create");
    };

    $scope.createTodo = function() {
        try {
            $scope.todo.labels = $scope.todo.labelsRaw.split(",");
        } catch (e) {
            $scope.todo.labels = [];
        }
        $scope.todo.date = $("#start").attr("value");
        window.console.log($scope.todo);
        $http.post($scope.TODOLIST.server.buildURL("todo", {}), JSON.stringify($scope.todo))
                .success(function(data, status) {
            $scope.setRoute("/list/" + $scope.id, "");
        }).error(function(data, status, headers, config) {
            $scope.TODOLIST.modal.update("Action failed", data.toString());
            $scope.TODOLIST.modal.show();
        });
    };


    $scope.fetch();
}
