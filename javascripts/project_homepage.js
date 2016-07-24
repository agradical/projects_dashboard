$(document).ready(function(){
    
    $('button#next').click(function(){
        var sort = $('#sort').val();
        var page = $('.pagination').data('page_id');
        $.ajax({
            url: "handlers/project_homepage_handler.php",
            data:{  page:page,
                    sort:sort
                },
            type:'POST',
            dataType:'json',
            success: function(result){
                if(result.success == 1) {
                    $('.container_body').html(result.html);
                    $('.pagination').data('page_id', page+1);
                    $('.footer').text("Page "+ (1+parseInt(page)));
                }
                else {
                    
                }
            }
        });

    });
    
    $('button#prev').click(function(){
        var sort = $('#sort').val();
        var page = $('.pagination').data('page_id');
        $.ajax({
            url: "handlers/project_homepage_handler.php",
            data:{  page:page-2,
                    sort:sort
                },
            type:'POST',
            dataType:'json',
            success: function(result){
                if(result.success == 1) {
                    $('.container_body').html(result.html);
                    $('.pagination').data('page_id', page-1);
                    $('.footer').text("Page "+ (parseInt(page)-1));
                }
                else {
                    
                }
            }
        });

    });
    
    $('button#next').trigger('click');
    
    $('#sort').change(function(){
        var sort = $('#sort').val();
        var page = $('.pagination').data('page_id');
        $.ajax({
            url: "handlers/project_homepage_handler.php",
            data:{  page:page-1,
                    sort:sort
                },
            type:'POST',
            dataType:'json',
            success: function(result){
                if(result.success == 1) {
                    $('.container_body').html(result.html);
                    $('.pagination').data('page_id', page);
                    $('.footer').text("Page "+page);
                }
                else {
                    
                }
            }
        });

    });
});
