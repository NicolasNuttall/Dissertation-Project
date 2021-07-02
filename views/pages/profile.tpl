{extends file="layouts/main.tpl"}
{if $profile_data}
{block name="body"}
    <div class="container-fluid m-0 p-0">
      <div class="profile-banner">
        <div class="banner-img" style="background-image: url(/Promotion/images/banners/{$profile_data.banner_img});"></div>
        <div class="profile-avatar">
          <img src="/Promotion/images/avatars/{$profile_data.avatar_img}" alt="">
        </div>
        <div class="profile-info">
          <h1>{$profile_data.username}</h1>
          <p class="profile-location"><span><i class="fas fa-map-marker-alt"></i></span>{$profile_data.location}</p>
          <p class="profile-desc">{$profile_data.biography}</p>
        </div>
        <div class="profile-button-box">
          {if $logged_user == $profile_data.username}
          <a href="/Promotion/profileEdit">Edit Profile</a>
          {else}
            {if $profile_data.following == true}
            <button data-username="{$profile_data.username}" type="button" id="unFollow" class="following">Unfollow</button>
            {else}
            <button data-username="{$profile_data.username}" type="button" id="follow" class="">Follow</button> 
            {/if}
          {/if}
        </div>
      </div>
    </div>
    <div class="container-fluid profile-main">
      <div class="row">
        <div class="profile-menu">
          <ul>
            <li><a href="/Promotion/profile/{$profile_data.username}">{$tab_data[4].amount} Tutorials</a></li>
            <li><a href="/Promotion/profile/{$profile_data.username}/followers">{$tab_data[3].amount} Followers</a></li>
            <li><a href="/Promotion/profile/{$profile_data.username}/following">{$tab_data[0].amount} Following</a></li>
            <li><a href="/Promotion/profile/{$profile_data.username}/likes">{$tab_data[2].amount} Likes</a></li>
            <li><a href="/Promotion/profile/{$profile_data.username}/finished">{$tab_data[1].amount} Finished</a></li>
          </ul>
        </div>
      </div>
      <div class="row mt-5">
        <div class="p-main mb-5 col">
          {if $pagehead}<h3>{$pagehead}</h3>{/if}
            {if $tutorials}
              <div class="tutorials-grid">
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
            {/if}
            {if $notutorialresults}
              <div class="no-results">
                <h4> No Tutorials {$na}</h4>
                <p class="no-results-text">There aren't any tutorials which fit the criteria</p>
              </div>
            {/if}
            {if $users}
            <div class="user-cards">    
              {foreach from=$users item=user}
                <div class="user-card">  
                  <a href="/Promotion/profile/{$user.username}">
                    <div class="comment-avatar">
                      <img src="/Promotion/images/avatars/{$user.avatar_img}" alt="{$user.username} avatar">
                    </div>
                    <div class="mr-4">
                      <p class="username">{$user.username}
                      <span class="follower-amount">{$user.followers} followers</span></p>
                      <p>{$user.biography}</p>
                    </div>         
                  </a>
                  {if $user.following == true}
                  <button data-username="{$user.username}" type="button" id="unFollow" class="following">Unfollow</button>
                  {else}
                  <button data-username="{$user.username}" type="button" id="follow" class="">Follow</button> 
                  {/if}
                </div>
              {/foreach}
            </div>
            {/if}
            {if $nouserresults}
              <div class="no-results">
                <h4> No Users</h4>
                <p class="no-results-text">We can't find any users who match the criteria.</p>
              </div>
            {/if}
        </div>  
        <div class="col-4 side-bar">
          <h3>Frequently discussed</h3>
          <div class="sim-categories">
            {if $popular_tags}
            {foreach from=$popular_tags key=key item=tag}
              <a class="sim-category" href="/Promotion/search/{$key}">{$key} 
                <p>{$tag.amount} Tutorials</p>
              </a>
            {/foreach}
            {else}
            <p class="sim-category"><em>Either no tutorials have been uploaded or no tags have been assigned to any of them.</em></p>
            {/if}
          </div>
        </div>
        </div>
        
      </div>
    </div>
{/block}
{else}
{block name="body"}

    <div class="not-found-container row">
        <div class="position-relative">
            <div class="mark-vector-2"></div>
            <h1>Page does not exist...</h1>
            <p>Sorry! We can’t seem to the find the page you’re looking for.</p>
            <a href="/Promotion/">Home Page</a>
        </div>
    </div>


{/block}
{/if}