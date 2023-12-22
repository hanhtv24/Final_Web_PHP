<?php
?>
<h1>Create an account</h1>
<form action="" method="post">
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label for="username" class="form-label">First name</label>
                <input type="text" name="firstname" class="form-control" id="username">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label for="username" class="form-label">Last name</label>
                <input type="text" name="lastname" class="form-control" id="username">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="username">
    </div>
    <div class="mb-3">
        <label for="lgPass" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="lgPass">
    </div>
    <div class="mb-3">
        <label for="cfPass" class="form-label">Confirm Password</label>
        <input type="password" name="confirmPassword" class="form-control" id="cfPass">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>