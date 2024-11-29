<div class="container mx-auto">
<form method="post" action="/signin">
    
     
    <div class="col-sm-12 mx-t3 mb-4 py-5">
        <h2 class="text-center text-info"><?=$title?></h2>
    </div>
      
    <div class="row">   

      <div class="col-10 form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email." required>
      </div>
     
      <div class="col-10 form-group">
        <label for="pass">Password</label>
        <input type="Password" name="password" class="form-control" id="pass" placeholder="Enter your password." required>
      </div>
      

      <div class="col-sm-10 form-group mb-0">
        <button class="btn btn-primary float-right">Submit</button>
      </div>

    </div>
  </form>
  </div>