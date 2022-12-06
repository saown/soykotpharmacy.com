$(document).ready(function (){
    $(document).on('click','.go-back', function (e){
        e.preventDefault();
        window.history.back();
    })
})