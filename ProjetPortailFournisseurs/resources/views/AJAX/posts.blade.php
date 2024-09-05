<!DOCTYPE html>
<html>
<head>
    <title>Laravel 11 Ajax Form Validation Example - ItSolutionStuff.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
         
<div class="container">
    <div class="card mt-5">
        <h3 class="card-header p-3"><i class="fa fa-star"></i> Laravel 11 Ajax Form Validation Example - ItSolutionStuff.com</h3>
        <div class="card-body">
      
            <table class="table table-bordered mt-3">
                <tr>
                    <th colspan="3">
                        List Of Posts
                        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#postModal"><i class="fa fa-plus"></i> 
                          Create Post
                        </button>
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Body</th>
                </tr>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->body }}</td>
                    </tr>
                @endforeach
            </table>
      
        </div>
    </div>
</div>
      
<!-- Modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="ajax-form" action="{{ route('posts.store') }}">
            @csrf
      
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
        
            <div class="mb-3">
                <label for="titleID" class="form-label">Title:</label>
                <input type="text" id="titleID" name="title" class="form-control" placeholder="Name">
            </div>
      
            <div class="mb-3">
                <label for="bodyID" class="form-label">Body:</label>
                <textarea name="body" class="form-control" id="bodyID"></textarea>
            </div>
         
            <div class="mb-3 text-center">
                <button class="btn btn-success btn-submit"><i class="fa fa-save"></i> Submit</button>
            </div>
        
        </form>
      </div>
    </div>
  </div>
</div>
         
</body>
      
<script type="text/javascript">
          
    /*------------------------------------------
    --------------------------------------------
    Form Submit Event
    --------------------------------------------
    --------------------------------------------*/
    $('#ajax-form').submit(function(e) {
        e.preventDefault();
         
        var url = $(this).attr("action");
        let formData = new FormData(this);
    
        $.ajax({
                type:'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    alert('Form submitted successfully');
                    location.reload();
                },
                error: function(response){
                    $('#ajax-form').find(".print-error-msg").find("ul").html('');
                    $('#ajax-form').find(".print-error-msg").css('display','block');
                    $.each( response.responseJSON.errors, function( key, value ) {
                        $('#ajax-form').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
           });
        
    });
      
</script>
      
</html>