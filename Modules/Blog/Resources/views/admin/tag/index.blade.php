@extends('layouts.admin')

@section('content')
<div class="container my-4">
  <h1 class="mb-4">Gestion des Tags</h1>

  <div class="card shadow">
    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center">
      <form method="GET" action="{{ route('tags.index') }}" class="d-flex flex-wrap gap-2 align-items-center">
        <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Rechercher un tag">
        <button type="submit" class="btn btn-primary">Rechercher</button>
      </form>
      <a href="{{ route('tags.create') }}" class="btn btn-success mt-3 mt-md-0">
        <i class="fas fa-plus-circle me-1"></i> Ajouter un tag
      </a>
    </div>

    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <table class="table table-hover table-bordered align-middle text-center">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tags as $tag)
            <tr>
              <td>{{ $tag->id }}</td>
              <td>{{ $tag->name }}</td>
              <td>
                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger btn-sm" title="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer ce tag ?')">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3">Aucun tag trouvé.</td>
            </tr>
          @endforelse
        </tbody>
      </table>

      <div class="d-flex justify-content-center mt-3">
        {{ $tags->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
