<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presto.it</title>
</head>
<body>
    <div>
        <h1>{{__('becomeStaff.beStaffTitleOne')}}</h1>
        <h2>{{__('becomeStaff.beStaffTitleTwo')}}</h2>
        <p>{{__('becomeStaff.beStaffName')}}{{$user->name}}</p>
        <p>{{__('becomeStaff.beStaffMail')}}{{$user->email}}</p>
        <p>{{__('becomeStaff.beStaffPar')}}</p>
        <a href="{{route('approved-reviser', compact('user'))}}">{{__('becomeStaff.beStaffLink')}}</a>
    </div>
</body>
</html>