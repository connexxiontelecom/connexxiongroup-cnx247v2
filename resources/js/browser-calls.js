$(function(){
		$(document).on('click', '.makeCall', function(e){
			e.preventDefault();
			var phone = parseInt($('#dialer-screen').text());
			const regEx = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
				axios.post('/conversation/call',{phoneNumber:phone})
				.then(response=>{
					console.log(response);
				})
				.catch(error=>{
					console.log(error);
				});

		});

});
