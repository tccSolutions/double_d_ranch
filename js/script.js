// delete
$(".delete").on("click", function(event){
    event.preventDefault();

    if(confirm("THIS CAN NOT BE UNDONE! Are you sure?")){
       var form = $("<form>");
       form.attr('method', 'post');
       form.attr('action', $(this).attr('href'));
       form.appendTo("body");
       form.submit();
    }

})


