
<form method="post" action="/signon">
    
     
    <div class="col-sm-12 mx-t3 mb-4">
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
      <div class="col-10 form-group">
        <label for="pass2">Confirm Password</label>
        <input type="Password" name="cnf-password" class="form-control" id="pass2" placeholder="Re-enter your password." required>
      </div>
     

      <div class="col-sm-10 form-group mb-0">
        <button class="btn btn-primary float-right">Submit</button>
      </div>

    </div>
  </form>