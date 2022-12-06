$(document).ready(function (){
   let links = $('a');
   for(let i = 0; i<links.length; i++){
      if (links[i].href === window.location.href){
         links[i].parentElement.classList.add('active');
      }
   }

   $(document).on('click', '.logout-btn', function (e){
      e.preventDefault();
      $.ajax({
         type: 'post',
         url : SITE_URL + 'logout',
         success: function (data){
            let responseJson = JSON.parse(data);
            let status = responseJson.status;
            let message = responseJson.message;
            if (Number(status) === 1) {
               Swal.fire({
                  icon: 'success',
                  title: 'Logout',
                  html: message,
               }).then((result) => {
                  if (result.isConfirmed){
                     window.location.href = SITE_URL+'login_admin';
                  }
               })
            }
         }
      })
   })
});