{extends file="layouts/accounts.tpl"}
{block name="account-body"}
    <div class="row log-page no-gutters">
            <div class="col login no-gutters d-flex justify-content-center align-items-center w=">
                <form class="text-left" method="POST" name="register" id="register" action="">
                    <h1>Sign up for free!</h1>
                    <div class="logform"  id="login-form">
                        <div class="log-field ">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email">
                        </div>
                        <div class="log-field ">
                            <label for="username">Username</label>
                            <input id="username" type="text" name="username">
                        </div>
                        <div class="log-field ">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password">
                        </div>
                        <div class="log-field ">
                            <label for="conf-password">Confirm Password</label>
                            <input id="conf-password" type="password" name="conf-password">
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
                        <button type="submit" name="register" value="1">Sign Up</button>
                        <a href="/Promotion/login">Already have an account? Sign in here</a> 
                    </div>
                 
                </form>
                
            </div>
            <div class="col acc-decor no-gutters d-flex justify-content-center align-items-center">
                <div class="acc-decor-contents">
                    <h2>"{$quote}"<span> -{$author}</span></h2> 
                </div>          
            </div>
        </div>
{/block}