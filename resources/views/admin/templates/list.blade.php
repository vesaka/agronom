@section('content')
<div class="table-responsive">
    <table id="entity-table" class="table table-striped">
        <thead>
            <tr>
                <td>ID</td>
                <td>Заглавие</td>
                <td>Описание</td>
                <td>Добавено</td>
                <td>Обнояване</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($entities as $entity)
            <tr>
                <td class="col-md-1">{{ $entity->id }}</td>
                <td class="col-md-2"><a href="{{ route("admin.$type.edit", $entity->id) }}" type="button">{{ $entity->name }}</a></td>
                <td class="col-md-3">{{ str_limit($entity->description) }}</td>
                <td class="col-md-2">{{ $entity->created_at }}</td>
                <td class="col-md-2">{{ $entity->updated_at }}</td>
                <td class="col-md-2">
                    <div class="btn-group">
                        <a href="{{ route("guest.view", [$type, $entity->slug]) }}" type="button" class="btn btn-primary" role="view-button"><i class="fa fa-search-plus"></i></a>
                        <a href="{{ route("admin.$type.edit", $entity->id) }}" type="button" class="btn btn-warning" role="edit-button"><i class="fa fa-edit"></i></a>
                        <button type="button" class="btn btn-danger" role="delete-button" data-id="{{ $entity->id }}"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@stop

@section('js')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#entity-table').DataTable({
                language: {
                    "sProcessing":   "Обработка на резултатите...",
                    "sLengthMenu":   "Показване на _MENU_ резултата",
                    "sZeroRecords":  "Няма намерени резултати",
                    "sInfo":         "Показване на резултати от _START_ до _END_ от общо _TOTAL_",
                    "sInfoEmpty":    "Показване на резултати от 0 до 0 от общо 0",
                    "sInfoFiltered": "(филтрирани от общо _MAX_ резултата)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Търсене във всички колони:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Първа",
                        "sPrevious": "Предишна",
                        "sNext":     "Следваща",
                        "sLast":     "Последна"
                    }
                }
            });
            
            $('[role="delete-button"]').click(function(e) {
                if (!confirm('Сигурни ли сте, че искате да изтриете този запис?')) {
                    return;
                }
                
                var route = '{{ route("admin.$type.remove", "_id_") }}';
                    
                $.ajax(route.replace('_id_', e.target.dataset.id), {
                    method: 'POST',
                    
                }).done(function(response) {
                    console.log(response);
                }).fail(function(response) {
                    console.log(response.responseText, response);
                });
            });
        });
    </script>
@stop

