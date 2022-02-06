<!DOCTYPE html>
<html>
  <head>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
      integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
      crossorigin="anonymous"
    ></script>
    <script src="/Readie/js/scripts-vendor.min.js"></script>
    <script src="/Readie/js/scripts.min.js"></script>
    <meta charset="utf-8" />
    <title>Readie - Stay Educated</title>
    <link rel="icon" href="/Readie/images/RLogo@4x.png">
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/Readie/css/styles.css" rel="stylesheet" />
    <script
      src="https://kit.fontawesome.com/d96356a49f.js"
      crossorigin="anonymous"
    ></script>
  </head>

  <body>
    <div class="create-custom-item-container">
      <div class="create-custom-item d-flex flex-column">
        <div class="close-pop-up">
          <i class="fas fa-times"></i>
        </div>
        <h3 class="mb-4">Create a Custom Item</h3>
        <label for="item-name">Item Name (optional)</label>
        <input class="mb-4" type="text" name="item-name" />
        <label for="item-author">Item Author (optional)</label>
        <input class="mb-4" type="text" name="item-author" />
        <label for="item-desc">Item Summary (optional)</label>
        <textarea
          name="item-desc"
          id="item-desc"
          cols="10"
          rows="5"
          class="mb-4"
        ></textarea>
        <label for="item-img">Item Cover Image (optional)</label>
        <input class="mb-5 mt-2" type="file" name="item-img" id="item-img" />
        <button class="green-button">Create Item</button>
      </div>
    </div>
    <nav class="vertical-nav pl-4" id="sidebar">
      <button id="sidebarCollapse" type="button" class="burgerbar-button">
        <i class="fa fa-bars"></i>
      </button>
      <a href="/Readie/">
        <img class="readie-logo mb-5" src="/Readie/images/ReadieLogo.png" alt="" />
      </a>
      {if $user_datas}
      
      <ul class="nav flex-column mb-0">
        <li class="nav-item">
          <a href="/Readie/bookshelf" class="nav-link">
            <i class="fa fa-th-large mr-3 fa-fw"></i>
            Bookshelf
          </a>
        </li>
        <li class="nav-item">
          <a href="/Readie/liked-notes" class="nav-link">
            <i class="fa fa-address-card mr-3 fa-fw"></i>
            Liked Notes
          </a>
        </li>
        <li class="nav-item">
          <a href="/Readie/journal" class="nav-link">
            <i class="fa fa-cubes mr-3 fa-fw"></i>
            Journal
          </a>
        </li>
        <li class="nav-item">
          <a href="/Readie/progress" class="nav-link">
            <i class="fa fa-picture-o mr-3 fa-fw"></i>
            Progress
          </a>
        </li>
        <li class="nav-item">
          <a href="/Readie/notes-archive" class="nav-link">
            <i class="fa fa-picture-o mr-3 fa-fw"></i>
            All Notes
          </a>
        </li>
      </ul>

      <p
        class="text-gray mt-5 font-weight-bold text-uppercase px-3 small py-4 mb-0"
      >
        Recent
      </p>

      <ul class="nav flex-column mb-0">
        {foreach from=$recent_books item=book}
        <li class="nav-item">
          <a href="/Readie/summary/{$book.BookID}" class="nav-link font-italic"> {$book.Title}</a>
        </li>
        {/foreach}
        <a class="login" href="/Readie/login"><span>Log out</span></a>
        
      </ul>
      {else}
      <ul class="nav flex-column mb-0">
        <a class="login" href="/Readie/register">Sign Up</a>
      </ul>
      {/if}
    </nav>
    {block name="main-body"} {/block}
    </div>
  </body>
</html>
