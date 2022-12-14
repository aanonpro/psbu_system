<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Add Faculty</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('faculties.store')}}" method="POST">
        @csrf
          <div class="modal-body py-4">

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control name" name="name" placeholder="Name en" autofocus>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Khmer</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control khmer" name="khmer" placeholder="name kh">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <select class="form-control" id="status" name="status" required>
                    <option value="">----select status----</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger clear" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary swalDefaultSuccess">Save</button>
          </div>
        </form>

      </div>
    </div>
  </div>


@section('script')

<script>
    var Toast = Swal.mixin({
     toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer: 3000
   });

   $(function() {
       $('.swalDefaultSuccess').click(function() {
           Toast.fire({
               icon: 'success',
               title: "{{ session('message')}}"
           })
       });

       //clear form fields
       $('.clear').click(function(){
          $('.name, .khmer').val('');
          $('#status')
            .find('option')
            .remove()
            .end()
            .append(' <option value="">----select status----</option>')
            .val('');
       });



   });
</script>

@endsection
