<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{ route('widget.test') }}" > 
        @csrf
        <label for="method_name">Nom de la méthode :</label>
        <input type="text" id="method_name" name="method_name" required>
        <button type="submit">Exécuter</button>
    </form>
    
    @if (isset($result))
        <h3>{{ $result['titre'] }}</h3>
        @if (isset($result['valeur']))
            <p>Valeur : {{ $result['valeur'] }}</p>
        @elseif (isset($result['liste']))
            <ul>
                @foreach ($result['liste'] as $apprenant)
                    <li>{{ $apprenant['nom'] }} ({{ $apprenant['email'] }})</li>
                @endforeach
            </ul>
            <p>Total Apprenants Actifs : {{ $result['total'] }}</p>
        @endif
    @endif
    
    @if (isset($error))
        <p style="color: red;">Erreur : {{ $error }}</p>
    @endif
</body>
</html>


