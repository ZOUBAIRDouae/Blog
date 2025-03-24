<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

@foreach($widgets as $widget)
<tr>
    <td>{{ $widget->name }}</td>
    <td>{{ $widget->method }}</td>
    <td>{{ $widget->type }}</td>
    <td>
        <form action="{{ route('widgets.update', $widget->id) }}" method="POST">
            @csrf
            @method('put')
            <button class="btn btn-primary updateWidgetBtn" data-id="{{ $widget->id }}">Modifier</button>
        </form>
        <form action="{{ route('widgets.destroy', $widget->id) }}" method="POST">
            @csrf
            @method('delete')
            <button class="btn btn-danger deleteWidgetBtn" data-id="{{ $widget->id }}">Supprimer</button>
        </form>
        </form>
    </td>
</tr>
@endforeach

</body>
</html>