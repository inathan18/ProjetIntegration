<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Multi-step Form in Laravel 9</title>
        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<style>
.form-section{
    display: none;
}

.form-section.current{
    display: inline;
}
.parsley-errors-list{
    color:red;
}

</style>





</head>
  <body>

    <div class="container-fluid  ">
      <div class="row justify-content-md-center">
        <div class="col-md-9 ">
            <div class="card px-5 py-3 mt-5 shadow">
               <h1 class="text-danger text-center mt-3 mb-4">Multi-step Form in Laravel 9</h1>

                        <div class="nav nav-fill my-3">
                          <label class="nav-link shadow-sm step0    border ml-2 ">Step One</label>
                          <label class="nav-link shadow-sm step1   border ml-2 " >Step Two</label>
                          <label class="nav-link shadow-sm step2   border ml-2 " >Step Three</label>
                        </div>
          
                <form action="/post" method="post" class="employee-form">
                 @csrf
                <div class="form-section">
                    <label for="">Name:</label>
                    <input type="text" class="form-control mb-3" name="name" required>
                    <label for="">Last Name:</label>
                    <input type="text" class="form-control mb-3" name="last_name" required>
                </div>
                <div class="form-section">
                    <label for="">E-mail:</label>
                    <input type="email" class="form-control mb-3" name="email" required>
                    <label for="">Phone:</label>
                    <input type="tel" class="form-control mb-3" name="phone"  required>
                </div>
                <div class="form-section">
                    <label for="">Address:</label>
                    <textarea name="address" class="form-control mb-3" cols="30" rows="5" required></textarea>
                </div>
              <div class="form-navigation mt-3">
                 <button type="button" class="previous btn btn-primary float-left">&lt; Previous</button>
                 <button type="button" class="next btn btn-primary float-right">Next &gt;</button>
                 <button type="submit" class="btn btn-success float-right">Submit</button>
              </div>

            </form>
        </div>
            
        </div>
      </div>
    </div>








  </body>
</html>