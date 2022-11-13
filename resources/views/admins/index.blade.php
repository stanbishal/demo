@extends('admins.layouts.master')

@section('content')
    
    <h1 class="text-center"></h1>
    <p id="message"></p>
    <div class="container row">
        <div class="col-md-2">
        </div>
        <div class="col-md-10">
      
            <table id="url_table">
                <thead>
                    <th>Full URL</th>
                    <th>Shortned URL</th>
                    <th>Action</th>
                </thead>

                <tbody>
                   
                </tbody>

            </table>
        </div>
    </div>

@endsection



@section('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(e) {


        var url = "{{ route('admin.index') }}";

        $.ajax({
            url:url,
            type: "GET",
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(resp) {
                if(resp.status=="success")
                {
                    $.each(resp.payload,function(key,value){
                	$('#url_table tbody').append('<tr> <td>'+value.original_url+'</td><td>'+value.short_url+'</td><td> <a class="btn btn-sm btn-success" href="/admin/view-link/'+value.id+'">View Url</a> <a class="btn btn-sm btn-danger delete" data-id='+value.id+' href="/admin/delete-link/'+value.id+'">Delete Url</a> </td></tr>');
                });
                }

            },           
        });


        $(document).on('click','.delete',function(e){

            var url = "{{ route('admin.delete', ":id") }}";
            var id = $(this).data('id');
            url = url.replace(':id', id);

            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
            url:url,
            data:{'id':id},
            type: "GET",
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(resp) {
                $("#message").empty().text(resp.message);
                if(resp.status=="success")
                {
                    location.reload();    
                }
            },           
        });
        });

});


</script>
@endsection

