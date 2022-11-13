
    <div class="container row">
        <div class="col-md-4">
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Full URL *</label>
                <a href="{{ $data->original_url }}" target="_blank" id="full_url">{{ $data->original_url }}</a>
            </div>

            <div class="mb-3">
                <label class="form-label">Short URL *</label>
                <a href="{{ $data->short_url }}"
                    target="_blank" id="short_url">{{ $data->short_url }}</a>
            </div>

            <div class="mb-3">
                <label class="form-label">Expiry date</label>
                <input type="date" class="form-control" id="expiry_date" value="{{ $data->expires_on }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Total visited</label>
                <input type="text" class="form-control" id="counter" value="{{ $data->counter }}" readonly>
            </div>
        </div>
    </div>


