@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Verify your new email',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <h4 class="secondary"><strong>Hi {{ $user->name}},</strong></h4>
		<p>You have changed your email address for {{config('app.name')}}.</p>
        <p>Follow this link to confirm your new email address: <br />
        <?php echo url(config('app.url').route('reset.email',['userid' =>$user->id,'token' =>$token],false));?>
        </p>
        <p><strong>Your new email:</strong> {{$new_email}}</p>
        <p>You received this email, because it was requested by a {{config('app.name')}} user. If you have received this by mistake, 
        please do not click the confirmation link, and simply delete this email. <br/>
        After a short time, the request will be removed from the system.</p>
        <p>Thank you,<br />
        The {{config('app.name')}} Team</p>

    @include('beautymail::templates.sunny.contentEnd')

        @include('beautymail::templates.sunny.button', [
                'title' => 'Verify New Email',
                'link' => url(config('app.url').route('reset.email',['userid' =>$user->id,'token' =>$token],false))
        ])

@stop
