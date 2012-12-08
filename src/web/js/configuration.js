String.prototype.endsWith = function(s) {
    return this.length >= s.length && this.substr(this.length - s.length) === s;
};


function TodoList() {

    /**
     * For dialogs. Properties modal, modalBody and modalHeader are IDs (with #) of elements in modal div
     * @type type
     */
    this.modal = {
        modal: "#myModal",
        modalBody: "#modal-body",
        modalHeader: "#myModalLabel",
        update: function(header, body) {
            $(this.modalHeader).text(header);
            $(this.modalBody).text(body);
        },
        show: function() {
            $(this.modal).modal('toggle');
        }
    };

    this.server = new function() {
        var p = this;
        this.preferredPattern = "php";
        this.endpoints = {
            "todolist": "http://localhost/todolist/src/rest/todolists.php",
            "list": "http://localhost/todolist/src/rest/list.php",
            "todo": "http://localhost/todolist/src/rest/todo.php"
        };
        this.patterns = {
            "php": function(endpoint, parameters) {
                var url = "";
                for (var parameter in parameters) {
                    try {
                        url += "&" + parameter + "=" + encodeURIComponent(parameters[parameter]);
                    } catch (e) {
                        console.error(e);
                    }
                }
                return (url.length > 1) ? p.endpoints[endpoint] + "?" + url : p.endpoints[endpoint];
            }

        };
        this.buildURL = function(endpoint, parameters) {
            var url = "";
            for (var parameter in parameters) {
                try {
                    url += "&" + parameter + "=" + encodeURIComponent(parameters[parameter]);
                } catch (e) {
                    console.error(e);
                }
            }
            return p.patterns[p.preferredPattern].call(undefined, endpoint, parameters);
        };
    };
}


