$(document).ready(function(){
    $('.del').on('click', function(){
        var column=$(this).closest('tr').find('td:eq(0)').text().trim()
        $.ajax({
            url:'delete.php',
            method:'POST',
            data:{column:column},
            success:function(data){
                $('#userss').html(data)
            }
        })
    })
})
$(document).ready(function(){
    $('.del').on('click', function(){
        var column=$(this).closest('tr').find('td:eq(0)').text().trim()
        $.ajax({
            url:'deletecategory.php',
            method:'POST',
            data:{column:column},
            success:function(data){
                $('#userss1').html(data)
            }
        })
    })
})
$(document).ready(function(){
    $('.del').on('click', function(){
        var column=$(this).closest('tr').find('td:eq(0)').text().trim()
        $.ajax({
            url:'deletetype.php',
            method:'POST',
            data:{column:column},
            success:function(data){
                $('#userss2').html(data)
            }
        })
    })
})
$(document).ready(function(){
    $('.del').on('click', function(){
        var column=$(this).closest('tr').find('td:eq(0)').text().trim()
        $.ajax({
            url:'deletedepartment.php',
            method:'POST',
            data:{column:column},
            success:function(data){
                $('#userss3').html(data)
            }
        })
    })
})