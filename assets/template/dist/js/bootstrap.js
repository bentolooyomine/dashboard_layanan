function login() {
    nik = $('#nik').val();
    password = $('#password').val();
    $.ajax({
               url: url,
               type: 'POST',
               data:{nik:nik,
                password:password},             
               success: function(data) {   	 
                       let obj = JSON.parse(data);      
               message = obj['message'];
              url = obj['url'];
              state = obj['state'];
              icon ='';            
              if(state == 200){
                icon ='success';
              }else{
                icon ='error';
               
              }
              Swal.fire({
                icon: icon,
                title: icon,
                text: message,
                footer: state
              });
              
  
              setTimeout(function () {
                      window.location.href = obj['url']; 
                      }, 2000); 
          
          
               }
           });
  }