@extends('admins.layouts.master')

@section('content')
    <div class="container row">
        <div class="col-md-4">
        </div>
        <div class="col-md-6">
            <form method="POST" action="{{ route('admin.link-details') }}" id="searchForm">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Chooose URL Type</label>
                    <select name="field" id="" class="form-control">
                        <option value="original_url">FUll URL</option>
                        <option value="short_url">Short URL</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">URL *</label>
                    <textarea name="value" id="" cols="30" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Search</button>
            </form>

        <p id="message"></p>

            <div id="partials">
                <div class="container row">

                    <div class="col-md-4">
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Full URL *</label>
                            <a href="" target="_blank" id="original_url"></a>
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label">Short URL *</label>
                            <a href=""
                                target="_blank" id="short_url"></a>
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label">Expiry date</label>
                            <input type="date" class="form-control" id="expiry_date" value="">
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label">Total visited</label>
                            <input type="text" class="form-control" id="counter" value="" readonly>
                        </div>
                    </div>
                </div>
            </div>
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

    $('#searchForm').on('submit', function(e) {
        
        e.preventDefault();
        var action = $(this).attr('action');
        var formData = new FormData(this);

    $.ajax({
        url:action,
        type: "POST",
        dataType: 'JSON',
        data:formData,
        contentType: false,
        cache: false,
        processData: false,

        success: function(res) 
        {
            if(res.status=="failed") {
                $("#message").text(res.message);
                $("#original_url").text(" ");
                $("#short_url").text(" ");
                $("#expiry_date").val(" ");
                $("#counter").val(" ");
            }else{
                $("#message").text(" ");
                $("#original_url").text(res.payload.original_url);
                $("#original_url").attr("href",res.payload.original_url);
                $("#short_url").text(res.payload.short_url);
                $("#short_url").attr("href",res.payload.short_url);
                $("#expiry_date").val(res.payload.expires_on);
                $("#counter").val(res.payload.counter);
            }
           
        },


    });

});


</script>
@endsection

