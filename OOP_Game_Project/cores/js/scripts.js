$(document).ready(function () {
    var ajax = {
        initAjax: function (action, data, callback) {
            $.ajax({
                url : "index.php?action="+action,
                type : "POST",
                data : data,
                success: function(data) {
                    callback(data);
                }
            });
        }
    }

    $(".action_player").on('submit', function () {
        method = $("input:checked").val();
        id_user = $("input[name='id_user']").val();

        data = {
            'method' : method,
            'id_user': id_user
        }

        ajax.initAjax('action', data, function(data) {
            console.log(data);
        });
        return false;
    });
})