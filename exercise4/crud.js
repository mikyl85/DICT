$(document).ready(function(){

    GetUserTable();
})


//get record from database
function GetUserTable()
{
    
    $.get("table.php", function(response){

        // convert string to JSON
        response = $.parseJSON(response);
       
        $('#table-data').html("");
        var table = "<table class='table table-responsive table-striped'>";
        table  += "<thead>" +
            "<tr>" +
            "<th class=\"text-center\">Name</th>" +
            "<th class=\"text-center\">Email</th>" +
            "<th class=\"text-center\">Password</th>" +
            "<th class=\"text-center\">Action</th>" +
            "</tr>" +
            "</thead><tbody>";

        $.each(response, function (i, item) 
        {
           
            table += '<tr><td>' + item.name + '</td><td>' + item.email + '</td><td>' + item.password + '</td>' +
            '<td class=\"text-center\">' +
                '<div class="btn-group">'+
                    '<button data-bs-toggle="modal" data-bs-target="#userModal" onclick=\"EditUser('+item.user_id+')\" class="btn btn-sm btn-primary">Edit</button> ' +
                    '<button onclick="DeleteUser('+item.user_id+')" class="btn btn-sm btn-danger">Delete</button>' +
                '</div>'+
            '</td></tr>';
        });
        table +="</tbody></table>";
      
        $('#table-data').append(table);


      });    

}



function EditUser(user_id)
{ 
    $.get("user.php",{ user_id: user_id  }, function(r){
        $('#userForm').html(r)
    })
}

function DeleteUser(user_id)
{
  
    if(confirm("Are you sure you want to delete this user?"))
    {
        $.get("delete.php",{ user_id: user_id  }, function(response){

           
             var i = response.replace(/\r?\n|\r/g,"");
             
             if(i == "OK")
             {
                GetUserTable();
                Toast("Selected user information, deleted.", "exclamation-square");
             }
             else
             {
                Toast(i, "exclamation-square");
             }
        })

    }
   

}

$(function(){

    $('#btnSaveUser').click(function(){
       
        var user_id = $('#user_id').val(),
            email = $('#email').val(),
            name = $('#name').val(),
            password=$('#password').val();
        
       
        if(name.length == 0 || email.length == 0 || password.length == 0)    
        {
           
           if(name.length == 0)
           {
                Toast("Missing data", "exclamation-square");
                setTimeout(function(){
                    $('#name').focus().select();
                },200)
           }
           else if(email.length == 0)
           {  
                Toast("Missing data", "exclamation-square");
                setTimeout(function(){
                    $('#email').focus().select();
                },200)
           }

           else if(password.length == 0)
           {  
                Toast("Missing data", "exclamation-square");
                setTimeout(function(){
                    $('#password').focus().select();
                },200)
           }

           if (!validateEmail(email)) 
           {
               Toast("Invalid Email Address", "exclamation-circle");
               setTimeout(function(){
                   $('#email').focus().select();
               },200)
              
               return false;
           }

            return false;
        }

        else
        {
            $.post("save.php",{ user_id: user_id, name: name, email: email, password: password  }, function(response){

               // console.log(response.replace(/\r?\n|\r/g, ""));
                //var i = response.replace(/\r?\n|\r/g,"");
               
                response = $.parseJSON(response);
               
               
                if(response[1] =="OK")
                {
                    if(user_id == 0)
                    {
                        $('#user_id').val(response[1]);
                        Toast("New User Information Saved.", "info-circle");
                    }
                   else{
                        Toast("Selected User Information modified.", "info-circle");
                   }
                   GetUserTable();
                }
                else
                {
                    Toast("Something went wrong.", "exclamation-square");
                }
            })
        }
 

    })
})


function validateEmail(email) 
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

function Toast(msg, icon)
{
    const toastLive = document.getElementById('liveToast')
    const toast = new bootstrap.Toast(toastLive)
    $('.toast-icon').addClass('bi-' +icon);
    $('#toast-msg').html(msg);

    toast.show();

    $(".toast").toast({ autohide: false });

}