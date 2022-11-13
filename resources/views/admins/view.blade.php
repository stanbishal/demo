    @extends('admins.layouts.master')

    @section('content')
        <div class="container row">
           
            <input type="hidden" value="{{ request()->route('id') }}" id="id">
            <div class="col-md-4">
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Full URL *</label>
                    <a href="" target="_blank" id="full_url"></a>
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
    @endsection

    @section('scripts')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function(e) {
                
                var url = "{{ route('admin.view', ":id") }}";
                var id = $("#id").val();
                url = url.replace(':id', id);

            $.ajax({
                url:url,
                type: "GET",
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

                success: function(res) {
                    if(res.status == "success")
                    {
                      
                        $('#full_url').attr('href',res.payload.original_url).text(res.payload.original_url);
                        $('#short_url').attr('href',res.payload.short_url).text(res.payload.short_url);
                        $('#expiry_date').val(res.payload.expires_on);
                        $('#counter').val(res.payload.counter);
                    }
                    else
                    {
                        alert(res.message);
                    }
                },


            });

        });


        </script>
    @endsection
