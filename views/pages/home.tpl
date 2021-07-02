{extends file="layouts/main.tpl"}

{if $user_datas}
  {block name="body"}
  <div class="results-section mx-auto ">
    <h4 class="home-heading underline">Featured Tutorials</h4>
    <div class="glide">        
      <div class="glide__track" data-glide-el="track">            
        <ul class="glide__slides">   
          {foreach from=$featured_tutorials item=featured}             
            <li class="glide__slide ">
              <a href="/Promotion/tutorial/{$featured.tutorial_id}">
              <div class="tutorial-slide-card">
                <div class="slide-front featured-cover-img" style="background-image:url('/Promotion/images/tutorial_images/{$featured.thumbnail_img}');">
                  <div class="featured-full-img" style="background-image:url('/Promotion/images/tutorial_images/{$featured.thumbnail_img}');"></div>
                  <div class="header-container">
                    <h2>{$featured.Title}</h2>
                  </div>
                </div>
              </div>
              </a>
            </li>                
          {/foreach}             
        
        </ul>        
      </div>  
      <div class="glide__arrows" data-glide-el="controls">                
        <button class="glide__arrow glide__arrow--left" data-glide-dir="<">&#129044;</button>                
        <button class="glide__arrow glide__arrow--right" data-glide-dir=">">&#10142;</button>            
      </div>  
    </div>
    <div class="d-flex filter-container mt-4">
      <h4 class="home-heading">{$homeheading}</h2> 
      <div class="filter-buttons-menu" >
        <a href="/Promotion/home/following" class="filter-buttons">Following</a>
        <a href="/Promotion/home/popular" class="filter-buttons">Popular</a>
        <a href="/Promotion/home/newest" class="filter-buttons">Newest</a>
      </div>
    </div>
    
    <div class="row search-results mt-3">   
        
        {if $tutorials}
            {foreach from=$tutorials item=tutorial}
            <div class="col card-container ">           
                <div class="postcard">
                    <a href="/Promotion/tutorial/{$tutorial.tutorial_id}"><span class="link"></span></a>
                    {if $tutorial.is_marked == true}  
                        <div class="mark-vector postmenu marked" id="unMark" data-tutorialid="{$tutorial.tutorial_id}"></div>                        
                    {else}
                    <div class="mark-vector postmenu" id="mark" data-tutorialid="{$tutorial.tutorial_id}"></div>
                    {/if}      
                    <div class="front">
                    <div class="thumbnail">
                        <img src="/Promotion/images/tutorial_images/{$tutorial.thumbnail_img}" alt="{$tutorial.Title} thumbnail image" class="thumbnail-img">
                    </div>
                    <div class="bottom-card">                      
                        <div class="post-caption pl-4 ">
                            <h3>{$tutorial.Title}</h3>
                            <p>{$tutorial.username}</p>
                            <div class="post-stats">
                                <div class="stat">
                                {if $tutorial.is_liked == true}
                                    <button class="like-container" id="unLike" type="button" data-tutorialid="{$tutorial.tutorial_id}">
                                        <span class="liked likes_number" >{$tutorial.likes_amount.amount}</span>
                                        <i class="far fa-heart  liked" ></i>
                                    </button>
                                {else}
                                    <button class="like-container" id="Like" type="button" data-tutorialid="{$tutorial.tutorial_id}">
                                        <span class="likes_number">{$tutorial.likes_amount.amount}</span>
                                        <i class="far fa-heart" ></i>
                                    </button>
                                {/if}       
                                </div>
                                <div class="stat">
                                    <p>{$tutorial.comments_amount.amount}</p>
                                    <i class="far fa-comments"></i>
                                </div>
                            </div> 
                        </div> 
                    </div> 
                    </div> 
                <div class="back"> 
                    <p>{$tutorial.description}</p>
                </div> 
                </div>
            </div>
            {/foreach}
        {else}
            <div class="no-results">
                <p> No Tutorials</p>
                <p class="no-results-text">Search around for some people to follow!</p>
            </div>
        {/if}
      </div>
      </div>
  {/block}
{else}
  {block name="body"}
  <div class="welcome-sec mr-auto ml-auto">
      <div class="welcome-text">
        <h1>Sign up to join our community of creators</h1>
        <p>Keep track of your favorite tutorials, take part in discussions, share what you know!  </p>
        <a href="/Promotion/login" class="login-but">LOGIN / REGISTER</a>
      </div>
      <img src="/Promotion/images/HomeImg.png" alt="" class="welcome-img">
    </div>
      <svg version="1.1"
        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
        x="0px" y="0px" width="100%" height="84.2px" viewBox="0 0 1921 84.2" style="enable-background:new 0 0 1921 84.2; fill:rgb(16, 16, 29);"
        xml:space="preserve" preserveAspectRatio="none">  
        <defs>
        </defs>
        <path class="st0" d="M0,19.5c0,0,311,68,531,24s548-56,752,15s320-27,405-35s233,34.8,233,34.8L1920,0H0V19.5z"/>
      </svg>

      <div class="container-fluid">
        <div class="row mt-5">
          <div class="col-md-12 mx-auto text-center">
            <h1>Top Posts</h2>
            <p>Here are some of our most popular tutorials!</p>
          </div>
        </div>
        <div class="results-section mx-auto mt-3">
        <div class="row search-results">
          {foreach from=$tutorials item=tutorial}
            <div class="col card-container ">           
              <div class="postcard">
                  <a href="/Promotion/tutorial/{$tutorial.tutorial_id}"><span class="link"></span></a>
                  {if $tutorial.is_marked == true}  
                      <div class="mark-vector postmenu marked" id="unMark" data-tutorialid="{$tutorial.tutorial_id}"></div>                        
                  {else}
                  <div class="mark-vector postmenu" id="mark" data-tutorialid="{$tutorial.tutorial_id}"></div>
                  {/if}      
                  <div class="front">
                  <div class="thumbnail">
                      <img src="/Promotion/images/tutorial_images/{$tutorial.thumbnail_img}" alt="{$tutorial.Title} thumbnail image" class="thumbnail-img">
                  </div>
                  <div class="bottom-card">                      
                      <div class="post-caption pl-4 ">
                          <h3>{$tutorial.Title}</h3>
                          <p>{$tutorial.username}</p>
                          <div class="post-stats">
                              <div class="stat">
                              {if $tutorial.is_liked == true}
                                  <button class="like-container" id="unLike" type="button" data-tutorialid="{$tutorial.tutorial_id}">
                                      <span class="liked likes_number" >{$tutorial.likes_amount.amount}</span>
                                      <i class="far fa-heart  liked" ></i>
                                  </button>
                              {else}
                                  <button class="like-container" id="Like" type="button" data-tutorialid="{$tutorial.tutorial_id}">
                                      <span class="likes_number">{$tutorial.likes_amount.amount}</span>
                                      <i class="far fa-heart" ></i>
                                  </button>
                              {/if}       
                              </div>
                              <div class="stat">
                                  <p>{$tutorial.comments_amount.amount}</p>
                                  <i class="far fa-comments"></i>
                              </div>
                          </div> 
                      </div> 
                  </div> 
                  </div> 
                <div class="back"> 
                    <p>{$tutorial.description}</p>
                </div> 
              </div>
            </div>
          {/foreach}
        </div>
      </div>
    </div>
  {/block}
{/if}