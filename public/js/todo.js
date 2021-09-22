$(document).ready(function(){
    const timer = setInterval(function() {
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //     url: 'todo',
        //     type: 'GET',
        //     success: function(data) {
        //     },
        //     error: function(data) {
        //         console.log(data);
        //     }
        // })
    }, 1000);

    //----- Open model CREATE -----//
    $('#btn-add').click(function () {
        $('#btn-save').val("add");
        $('#myForm').trigger("reset");
        $('#formModal').modal('show');
    });

    // CREATE
    $(document).on("click", "#btn-save", function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = {
            title: $('#title').val(),
            description: $('#description').val(),
        };
        var state = $('#btn-save').val();
        var type = "POST";
        var todo_id = $('#todo_id').val();
        var ajaxurl = 'todo';

        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var todo = '<tr id="todo' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td></tr>';
                if (state == "add") {
                    $('#todos-list').append(todo);
                } else {
                    $("#todo" + todo_id).replaceWith(todo);
                }
                $('#myForm').trigger("reset");
                $('#formModal').modal('hide')
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    });
});