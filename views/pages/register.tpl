{extends file="layouts/accounts.tpl"}
{block name="account-body"}
<form action="" method="POST" name="register" id="register"   class="acc-form" autocomplete="nope">
    <h1>Register an Account</h3>
    <div class="input-section">
      <input autocomplete="nope" type="email" class="acc-field" id="email" placeholder=" " name="email">
      <label for="email" class="login-label">Email</label>
    </div>
    <div class="input-section">
      <input type="text" class="acc-field" id="username"  placeholder=" " name="username">  
      <label for="username" class="login-label">Username</label>
    </div>
    <div class="input-section">
      <input type="password" class="acc-field" id="password"  placeholder=" " name="password">  
      <label for="password" class="login-label">Password</label>
    </div>
    <div class="input-section">
      <input type="password" class="acc-field" id="conf-password"  placeholder=" " name="conf-password">  
      <label for="conf-password" class="login-label">Confirm Password</label>
    </div> 
    {if $error}
    <div class="alert alert-danger mt-1" role="alert">
        {$error}
    </div>
    {/if}
    {if $success}
        <div class="alert alert-success" role="alert">
            {$success}
        </div>
    {/if}
    <button type="submit" name="register" value="1">Register</button>
    <a href="/Readie/login">Already have an account? Sign in here</a>
</form>
{/block}