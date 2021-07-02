{extends file="layouts/main.tpl"}
{if $tutorial}
{block name="body"}
<div class="container post-page">
    <div class="row">
      <div class="post-container">
        <div class="post-info">   
            <h1 class="post-title">{$tutorial.Title}</h4>      
            
        </div>
        <div class="d-flex author-info">
            <p>By
                <span>
                    <a class="post-user" href="/Promotion/profile/{$tutorial.username}"> {$tutorial.username}</a>  | 
                </span>
            </p>
            <p class="ml-3"><span><i class="fas fa-clock clock" ></i></span> {$tutorial.age}</p>
        </div>
        <div class="tags">
        {foreach from=$tags item=tag}

            <a class="tag" href="/Promotion/search/{$tag.Tag}">{$tag.Tag}</a>
        {/foreach}
        </div>
        <div class="tutorial-main">
            <div class="tutorial-img-container">
                <img class="post-image" src="/Promotion/images/tutorial_images/{$tutorial.thumbnail_img}">
            </div>
            {if $user_datas}
            <div class="d-flex tut-buttons">
                {if $user_datas.username == $tutorial.username}
                    <button class="deleteButton" id="deleteTutorial" data-tutorialid="{$tutorial.tutorial_id}">Delete </button>
                {/if}
                <div class="mark-button-box">   
                    {if $is_marked}  
                    <button id="unMark" class="mark-done finished" data-tutorialid="{$tutorial.tutorial_id}">Unmark as Finished</button>
                    {else}
                    <button id="mark" class="mark-done" data-tutorialid="{$tutorial.tutorial_id}">Mark as Finished</button>
                    {/if}
                </div>
                {if $is_liked}
                    <button class="like-container" id="unLike" type="button" data-tutorialid="{$tutorial.tutorial_id}"><span class="liked" id="likes_number">{$tutorial_likes.amount}</span><i class="far fa-heart post-like liked" ></i></button>
                {else}
                    <button class="like-container" id="Like" type="button" data-tutorialid="{$tutorial.tutorial_id}"><span id="likes_number">{$tutorial_likes.amount}</span><i class="far fa-heart post-like" ></i></button>
                {/if}
            </div>
            {/if}
        </div>
        <p class="tut-content">{$tutorial.tutorial_content}</p>           
        <div class="comment-section">
            <h3>{count($comments)} Comments</h3>
        {if $user_datas}
            <div class="comment-sub">
                <div class="comment-avatar">
                    <img src="/Promotion/images/avatars/{$user_datas.avatar_img}" alt="{$user_datas.username} avatar" class="avatar">
                </div>
                <div class="comment-sub-right">
                    <textarea rows='1' wrap="off" placeholder="Add your comment here" name="commentText" id="commentText"></textarea>
                    <button id="comment" name="comment" type="button" data-tutorialid="{$tutorial.tutorial_id}">Submit</button>
                </div>
            </div>
        {else}
            <p>Sign in to leave a comment</p>
        {/if}
        {foreach from=$comments item=comment }
            <div class="comment-box">
                <a href="/Promotion/profile/{$comment.username}" class="comment-avatar">
                    <img src="/Promotion/images/avatars/{$comment.avatar_img}" alt="" class="avatar">
                </a>
                <div class="comment-info">
                    <p><a href="/Promotion/profile/{$comment.username}" class="comment-username">{$comment.username} </a><span>{$comment.age}</span></p>
                    <p class="comment-text">{$comment.comment_text}</p>    
                    
                </div>              
            </div> 
        {/foreach}     
        </div>
        </div>
        <div class="col related-posts">
            <h2>Related Tutorials</h2>
            {if $oth_tutorials}   
            <div class="rel-post-container">   
                {foreach from=$oth_tutorials item=oth}           
                <div class="rel-post">
                    <a href="/Promotion/tutorial/{$oth.tutorial_id}"><span></span></a>
                    <div class="rel-thumbnail">
                        <img src="/Promotion/images/tutorial_images/{$oth.thumbnail_img}" alt="{$oth.Title} thumbnail">
                    </div>
                    <div class="rel-text-box">
                        <h4>{$oth.Title}</h4>
                        <p>{$oth.username}</p>
                        <div class="post-stats">
                            <div class="stat">
                                {if $oth.is_liked == true}
                                    <button class="like-container" id="unLike" type="button" data-tutorialid="{$oth.tutorial_id}">
                                        <span class="liked likes_number" >{$oth.likes_amount.amount}</span>
                                        <i class="far fa-heart  liked" ></i>
                                    </button>
                                {else}
                                    <button class="like-container" id="Like" type="button" data-tutorialid="{$oth.tutorial_id}">
                                        <span class="likes_number">{$oth.likes_amount.amount}</span>
                                        <i class="far fa-heart" ></i>
                                    </button>
                                {/if}   
                            </div>
                            <div class="stat">
                                <p>{$oth.comments_amount.amount}</p>
                                <i class="far fa-comments"></i>
                            </div>
                        </div>
                    </div>
                {if $oth.is_marked == true}  
                    <div class="mark-vector postmenu marked" id="unMark" data-tutorialid="{$oth.tutorial_id}"></div>                        
                {else}
                    <div class="mark-vector postmenu" id="mark" data-tutorialid="{$oth.tutorial_id}"></div>
                {/if}      
            </div>         
            {/foreach}
            {/if}
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