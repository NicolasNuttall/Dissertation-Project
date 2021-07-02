{extends file="layouts/accounts.tpl"}
{block name="account-body"}
    <div class="row log-page no-gutters">
            <div class="col login no-gutters d-flex justify-content-center align-items-center">
                <form class="text-left" action="" method="POST" name="login" id="login">
                    <h2>Log into an existing account</h2>
                    <div class="logform"  id="login-form">
                        <div class="log-field ">
                            <label for="email">Email</label>
                            <input id="email" type="text" name="email">
                        </div>
                        <div class="log-field ">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password">
                        </div>
                        <button type="submit" name="login" value="1">Sign In</button>
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
                        <a href="/Promotion/register">Need an account? Sign up here.</a> 
                    </div>
                </form>
            </div>
            <div class="col acc-decor no-gutters d-flex justify-content-center align-items-center">
                <div class="acc-decor-contents">
                    <h2>"{$quote}"<span> -{$author}</span></h2>     
                </div>          
            </div>
        </div>
    </div>
{/block}