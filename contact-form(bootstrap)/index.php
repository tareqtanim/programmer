<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/cs.css" type="text/css" />

  </head>

<body>
<section>
<div class="container">
	<div class="col-md-6 col-md-offset">
		<form id="contact" class="form-horizontal well">
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1">
  <h3>Contact Me!</h3>
  
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
      <input id="name" type="text" class="form-control" name="name" placeholder="Your name">
    </div>
  <br/>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
      <input id="email" type="text" class="form-control" name="email" placeholder="Email">
    </div>
	<br/>
    <div class="input-group">
      <span class="input-group-addon">Text</span>
	  <textarea rows="5" cols="50" name="message" id="message" class="form-control" style="resize:none" placeholder="Your message"></textarea> 
    </div>
	
   
	<br/>
   <!-- <div class="form-group">        
      <div class="col-sm-offset-8 col-sm-10">
        <button type="submit" class="btn btn-info">Send Message</button>
      </div>
    </div>-->
	
	<div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                       <div id="msg"></div>
                       <button class="btn btn-lg btn-info pull-right" id="submit-btn">Send Message</button>
                    </div>
                  </div>
	
  
</div>



</div>
</form>
</div>
</div>
</section>
</body>
<script>
    /* global $ */
    $(document).ready(function(){
      $('#submit-btn').click(function(event){
        event.preventDefault();
         $.ajax({
            dataType: 'JSON',
            url: 'sendmail.php',
            type: 'POST',
            data: $('#contact').serialize(),
            beforeSend: function(xhr){
              $('#submit-btn').html('SENDING...');
            },
            success: function(response){
              if(response){
                console.log(response);
                if(response['signal'] == 'ok'){
                 $('#msg').html('<div class="alert alert-success">'+ response['msg']  +'</div>');
                  $('input, textarea').val(function() {
                     return this.defaultValue;
                  });
                }
                else{
                  $('#msg').html('<div class="alert alert-danger">'+ response['msg'] +'</div>');
                }
              }
            },
            error: function(){
              $('#msg').html('<div class="alert alert-danger">Errors occur. Please try again later.</div>');
            },
            complete: function(){
              $('#submit-btn').html('SEND MESSAGE');
            }
          });
      });
    });
</script>
</html>