 $(".act_addition").validate({
	rules: {
	},
	messages: {
	},
	errorPlacement: function(error, element) {
    if (element.is(":checkbox"))
      error.appendTo(element.closest('.row'));
    else
      error.insertAfter(element);
	},
	submitHandler: function(form){
		$this = jQuery(form);
      //$this.find('.msg').html('');
      var formData = $this.serialize();
      $this.find('button').attr('disabled',true);
	  $this.find('button').text('Please wait...');

    $.ajax({
      url: 'data/data.php',
      type: "POST",
      dataType: 'json', 
      data: formData+'&ajax=1',
      success: function(response){
		if(response.success=="YES"){
          window.location = 'pdf.php?data=0';
		}  else {
			$this.find('button').attr('disabled',false);
			$this.find('button').text('PDF Generate');
		}
   
      },
      error: function(error){
        $this.find('.btn').attr('disabled',false); 
        
      }   
    });
	}
  
  });