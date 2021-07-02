<!DOCTYPE html>
<html>

<head>
  <script src="/Promotion//js/scripts-vendor.min.js"></script>
  <meta charset="utf-8">
  <title>Promotion - Sharing animation tips for free!</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/Promotion/css/styles.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/d96356a49f.js" crossorigin="anonymous"></script>
</head>


<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light container-fluid">
      <div class="container">
        <a href="/Promotion/" class="navbar-brand"><img src="/Promotion/images/LogoDark.png" alt=""></a>
        <button class="navbar-toggler" data-toggle="collapse" type="button" data-target="#navSupCont" aria-controls="navSupCont" aria-expanded="false" aria-label="Toggle Navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navSupCont">
          
          <form action="" method="POST" name="search" class="my-2 my-lg-0 mx-auto searchbar">
            <input placeholder="Search for tutorials" name="query" aria-label="Search" type="search" class="form-control rounded-0 mr-0">
            <button type="submit" name="search" class="ml-0 my-sm-0 rounded-0 search-button">Search</button>
          </form>
          {if $user_datas}
            <ul class="navbar-nav mr-0">
              <li class="nav-item dropdown" id="nav-drop">
                <a href="#" id="profile-menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="/Promotion/images/avatars/{$user_datas.avatar_img}" alt="" class="avatar-img">
                </a>
                <div class="dropdown-menu" aria-labelledby="profile-menu">
                  <a class="dropdown-item drp" href="/Promotion/profile/{$user_datas.username}">Your Profile</a>
                  <a class="dropdown-item drp" href="/Promotion/profile/{$user_datas.username}/likes">Your Likes</a>
                  <a class="dropdown-item drp" href="/Promotion/profile/{$user_datas.username}/finished">Your Finished</a>
                  <a class="dropdown-item drp" href="/Promotion/profile/{$user_datas.username}/followers">Your Followers</a>
                  <a class="dropdown-item drp" href="/Promotion/profile/{$user_datas.username}/following">Your Following</a>
                  <a class="dropdown-item drp" href="/Promotion/login">Log out</a>
                </div>
              </li>
              
              <a class="upload-but" href="/Promotion/upload">Upload </a>
            </ul>
          {else}
            <a class="upload-but" href="/Promotion/register">Register</a>
          {/if}
        </div>
      </div>
    </nav>




    {block name="body"}{/block}
    




    <footer class="page-footer font-small mainfooter container-fluid pt-5">
      <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-2">
          <ul class="footerlist">
            <li><a href="/Promotion/"><img src="/Promotion/images/LogoWhite.png" alt=""></a></li>
            <li>We aspire to connect animators globaly and provide free learning for those who aspire to be better</li>
          </ul>
        </div>
        <div class="col-lg-2">
          {if $user_datas}
          <ul class="footerlist">
            <li><h3>Profile</h3></li>
            <li><a href="/Promotion/profile/{$user_datas.username}">Your profile page</a></li>
            <li><a href="/Promotion/profile/{$user_datas.username}/likes">Your Likes</a></li>
            <li><a href="/Promotion/profile/{$user_datas.username}/finished">Your Finished</a></li>
            <li><a href="/Promotion/profile/{$user_datas.username}/followers">Your Followers</a></li>
            <li><a href="/Promotion/profile/{$user_datas.username}/following">Your Following</a></li>
            <li><a href="/Promotion/profileEdit">Edit your Profile</a></li>
          </ul>
          {/if}
        </div>
        <div class="col-lg-2">
          <ul class="footerlist">
            <li><h3>Account</h3></li>
            <li><a href="/Promotion/login">{if $user_datas} Log out {else} Log in {/if}</a></li>
            <li><a href="/Promotion/register">Create an account</a></li>
          </ul>
        </div>
        
      </div>
    </footer>
    <script src="/Promotion/js/scripts.min.js"></script>
    <script>new Glide('.glide').mount(),{
      type:'carousel',
      perView:1
    }</script>
</body>

</html>