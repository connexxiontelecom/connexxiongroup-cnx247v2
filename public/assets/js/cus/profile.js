     $(document).ready(function(){
         $(document).on('click', '#avatarHandler', function(e){
             e.preventDefault();
             $('#avatar').click();
             $('#avatar').change(function(ev){
                 let file = ev.target.files[0];
                let reader = new FileReader();
                var avatar='';
                reader.onloadend = (file) =>{
                    avatar = reader.result;
                    $('#avatar-preview').attr('src', avatar);
                    axios.post('/upload/avatar',{avatar:avatar})
                    .then(response=>{
                    })
                    .catch(error=>{
                        });
                    }
                    reader.readAsDataURL(file);

                });
         });
         $(document).on('click', '#coverPhotoHandle', function(e){
             e.preventDefault();
             $('#cover_photo').click();
             $('#cover_photo').change(function(ev){
                 let file = ev.target.files[0];
                let reader = new FileReader();
                var cover='';
                reader.onloadend = (file) =>{
                    cover = reader.result;
                    $('#cover-preview').attr('src', cover);
                    axios.post('/upload/cover',{cover:cover})
                    .then(response=>{
                        location.reload();
                    })
                    .catch(error=>{
                            //$.notify("Error! Couldn't upload profile try again.");
                        });
                    }
                    reader.readAsDataURL(file);

                });
         });

         $(document).on('click', '#submitResignationBtn', function(e){
            e.preventDefault();
            var subject = $('#subject').val();
            var content = tinymce.get('resignation_content').getContent();
            axios.post('/resignation', {subject:subject, content:content})
            .then(response=>{
                alert(response.data.message);
            })
            .catch(error=>{

            });
        });
         $(document).on('click', '#add_section', function(event){
            event.preventDefault();
            const $lastRow = $('.form-wrapper:last');
            const $newRow = $lastRow.clone();
            $newRow.find('input').val('');
            $newRow.insertAfter($lastRow);
        });

        //Remove line
         $(document).on('click', '.remove_section', function(e){
            e.preventDefault();
            $(this).closest('.form-wrapper').remove();
        });
     });
