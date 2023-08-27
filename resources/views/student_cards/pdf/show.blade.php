<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    Email: {{ $card->user->email }}

    Interne: {{ $card->is_internal === true ? 'Oui' : 'Non' }}

    Date de naissance: {{ $card->date_of_birth->format('d/m/y') }}
    
</body>
</html>

