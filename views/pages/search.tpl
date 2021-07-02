{extends file="layouts/main.tpl"}
{block name="body"}
    <div class="results-section mx-auto">
        <div class="search-top">
            <h1 class="mb-1 pb-2 search-query">"{$query}"</h1>
            <p>{count($tutorials)} results found</p>    
        </div>
        <div class="row search-results m22">   
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
                    <p class="no-results-text">Couldn't find anything, try searching for something else!</p>
                </div>
            {/if}
        </div>
    </div>
{/block}