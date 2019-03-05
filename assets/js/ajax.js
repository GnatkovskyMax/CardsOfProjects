
$('body').on('click', function(e){
    var t=  e.target;
    var f = t.className;
    if(f.indexOf('editManagerAjax')!==-1){
        e.preventDefault();
        var editManagerAjax= new FormData();
        var name = $('#inputName').val();
        var email = $('#inputEmail').val();
        var phone = $('#inputPhone').val();
        var company = $('#inputCompany').val();
        var id =  $('#inputId').val();
        editManagerAjax.append('name', name);
        editManagerAjax.append('email', email);
        editManagerAjax.append('phone', phone);
        editManagerAjax.append('company', company);
        editManagerAjax.append('id', id);
        $.ajax({
            url: "/ajax/editManagerAjax",
            type: "POST",
            data: editManagerAjax,
            processData: false,
            contentType: false,
            complete: function () {
                alert("complete");
            },
            success: function (json) {
                $(".wrapp-general-edit").html($(".wrapp-general-edit", json).html());
            }

        })
    }
    else if(f.indexOf("delPhotoManager")!==-1){
        var data = $(t).attr('data-id');
        var file = $('.file-delPhotoManager').attr('src');
        console.log(file);
        $.post("/ajax/delPhotoManager",
            {id: data,
             file: file
            },
            function(data){
                $( ".wrapp-delete-photo" ).html(data);
            });
    }
    else if(f.indexOf("allManagers")!==-1){
        e.preventDefault();

        var allManager= new FormData();
        var id =  $(t).attr('data-id');
        var str = '.wrapp-for-managers'+id;
        allManager.append('id', id);
        $.ajax({
            url: "/ajax/allManagers",
            type: "POST",
            data: allManager,
            processData: false,
            contentType: false,
            success: function (json) {
           $('.wrapp-for-managers').html('');
                $(str).html(json);
            }
    });
    }
    else if(f.indexOf("allProjects")!==-1){
        e.preventDefault();
        var allProjects= new FormData();
        var id =  $(t).attr('data-id');
        var str = '.wrapp-for-projects'+id;
        allProjects.append('id', id);
        $.ajax({
            url: "/ajax/allProjects",
            type: "POST",
            data: allProjects,
            processData: false,
            contentType: false,
            success: function (json) {
                $('.wrapp-for-projects').html('');
                $(str).html(json);
            }
        });
    }
    else if(f.indexOf("upPhotoManager")!==-1) {
        e.preventDefault();

        $('.fileManager').change(function(){
            var fd = new FormData();
            var id =$(this).attr('data-manager-id');
            console.log(id);
            console.log(this.files[0]);
            fd.append("max", this.files[0]);
            fd.append("id", id);
            $.ajax({
                url: "/ajax/upPhotoManager",
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,

                success: function(json){

                    $(".wrapp-delete-photo").html($(".wrapp-update", json).html());
                }

            });


        });
        $('.fileManager').trigger('change');
    }


});





