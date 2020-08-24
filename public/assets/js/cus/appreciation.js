$(document).ready(function(){
    $('.appreciation-cus-preloader').hide();
        /*
        * Create new appreciation
        */ 
       $(document).on('click', '#submitAppreciation', function(e){
        e.preventDefault(); 
        app_form = new FormData;
        app_form.append('content', tinymce.get('appreciation_text').getContent());
        app_form.append('persons', JSON.stringify($('#appreciating').val()));
        $('.appreciation-cus-preloader').show();
         $('#submitAppreciation').attr('disabled', 'disabled');
        axios.post('/appreciation/new', app_form)
        .then(response=>{ 
             $('.appreciation-cus-preloader').hide();
             $('#submitAppreciation').removeAttr('disabled');
        })
        .catch(error=>{

        });
    });
});