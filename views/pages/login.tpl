{extends file="layouts/accounts.tpl"}
{block name="account-body"}
<form action="" method="POST" name="login" id="login" class="acc-form" autocomplete="off" >
    <h1>Login</h3>
    <div class="input-section">
      <input autocomplete="nope" type="username" class="acc-field" id="username" placeholder=" " name="username">
      <label for="username" class="login-label">Username</label>
    </div>
    <div class="input-section">
      <input type="password" class="acc-field" id="password"  placeholder=" " name="password">  
      <label for="password" class="login-label">Password</label>
    </div>
    <button type="submit" name="login" value="1">Log in</button>
    {if $error}
      <div class="alert alert-danger mt-1" role="alert">
          {$error}
      </div>
    {/if}
    {if $success}
      <div class="alert alert-success role="alert">
          {$success}
      </div>
    {/if}
    <a href="/Readie/register">Need an account? Sign up for free here!</a>
</form>
{/block}