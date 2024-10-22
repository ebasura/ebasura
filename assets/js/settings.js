$(document).ready(function(){
    var notyf = new Notyf({duration: 1000, position: {x: 'right', y: 'top',}});

    $("#changeCurrentBinButton").on('click', function(e){
        e.preventDefault();

        let trashBin = $('#trash_bin_selector').val();

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data: {
                action: 'editCurrentTrashBin',
                bin_id: trashBin
            },
            success: function(data) {
                let res = JSON.parse(data);

                if(res.success){
                    notyf.success(res.message)
                    setTimeout(function(){
                        location.reload();
                    }, 1000)
                } else {
                    notyf.error(res.message)
                }
            }
        })
    })
})
   