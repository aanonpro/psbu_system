<div class="col-md-4">
    <form action="{{ route('faculty.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile04"
                aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="file" required>
            <button class="btn btn-success" id="inputGroupFileAddon04"><i class="fa fa-cloud-download" aria-hidden="true"></i> Import</button>
        </div>                           
    </form>
</div>
<div class="col-md-2">
    <a class="btn btn-warning float-left" href="{{ route('faculty.export') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Export</a>
</div>