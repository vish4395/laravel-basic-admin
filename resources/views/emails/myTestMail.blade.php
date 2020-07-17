<!DOCTYPE html>
<html>
<head>
    <title>{{ $details['title'] }}</title>
</head>
<body>
<p>Hi,
You have changed your email address for {{config('app.name')}}.<br/>
Follow this link to confirm your new email address:<br/>

<?php echo url(config('app.url').route('reset.email',['userid' =>$details['userid'],'token' =>$details['token']],false));?>

<h4>Your new email:</h4><p> {{$details['new_email']}}</p>
<p>You received this email, because it was requested by a Laracrud. user. If you have received this by mistake, 
please DO NOT click the confirmation link, and simply delete this email. <br/>
After a short time, the request will be removed from the system.<p>

Thank you,
The Laracrud. Team
</body>
</html>