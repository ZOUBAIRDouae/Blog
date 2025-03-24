<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- Bouton Ajouter un Widget -->
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createWidgetModal">Ajouter Widget</button>

<!-- Modal Création -->
<div class="modal fade" id="createWidgetModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Widget</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createWidgetForm" method="POST" action="{{ route('widgets.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label>Nom</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Méthode</label>
                        <input type="text" name="method" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option value="number">Number</option>
                            <option value="list">List</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Édition (rempli dynamiquement en JS) -->
<div class="modal fade" id="editWidgetModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier Widget</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editWidgetForm" method="POST" action="{{ route('widgets.store')}}">
                    @METHODE('PUT')
                    @csrf
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label>Nom</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Méthode</label>
                        <input type="text" name="method" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option value="number">Number</option>
                            <option value="list">List</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Liste des Widgets -->
<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Méthode</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="widgetTable">
        <!-- Les widgets seront affichés ici via AJAX -->
    </tbody>
</table>

<script>
$(document).ready(function() {
    loadWidgets();

    // Charger la liste des widgets
    function loadWidgets() {
        $.get("{{ route('widgets.index') }}", function(data) {
            $("#widgetTable").html(data);
        });
    }

    // Ajouter un Widget
    $("#createWidgetForm").submit(function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.post("{{ route('widgets.store') }}", formData, function(response) {
            $("#createWidgetModal").modal('hide');
            loadWidgets();
        }).fail(function(xhr) {
            alert(xhr.responseJSON.message);
        });
    });

    // Ouvrir le modal de modification
    $(document).on("click", ".editWidgetBtn", function() {
        let id = $(this).data("id");

        $.get("{{ url('widgets') }}/" + id + "/edit", function(widget) {
            $("#editWidgetForm input[name='id']").val(widget.id);
            $("#editWidgetForm input[name='name']").val(widget.name);
            $("#editWidgetForm input[name='method']").val(widget.method);
            $("#editWidgetForm select[name='type']").val(widget.type);
            $("#editWidgetModal").modal('show');
        });
    });

    // Modifier un Widget
    $("#editWidgetForm").submit(function(e) {
        e.preventDefault();
        let id = $("#editWidgetForm input[name='id']").val();
        let formData = $(this).serialize();

        $.ajax({
            url: "{{ url('widgets') }}/" + id,
            method: "PUT",
            data: formData,
            success: function(response) {
                $("#editWidgetModal").modal('hide');
                loadWidgets();
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    });

    // Supprimer un Widget
    $(document).on("click", ".deleteWidgetBtn", function() {
        let id = $(this).data("id");
        if (confirm("Voulez-vous vraiment supprimer ce widget ?")) {
            $.ajax({
                url: "{{ url('widgets') }}/" + id,
                method: "DELETE",
                success: function(response) {
                    loadWidgets();
                }
            });
        }
    });
});
</script>

</body>
</html>