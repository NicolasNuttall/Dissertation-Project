{extends file="layouts/main.tpl"}
{block name="body"}
    <div class="container">
        <form id="upload-form" class="upload-form mx-auto"  enctype="multipart/form-data" method="POST" action="">
            <div class="row">
                <div class="col">
                    <div class="tut-main-details">
                        <h3 class="mb-4">Write your Tutorial *</h3>
                        <div class="form-inp">
                            <input placeholder="Title" name="Title" id="Title" type="text">
                        </div>
                        <div class="form-inp">
                            <input id="description" name="description" placeholder="Description" type="text">
                        </div>
                        <div class="form-inp">
                            <textarea placeholder="Write your tutorial here" class="expandText" name="tutorial_content" id="tutContent" type="text"></textarea>
                        </div>                  
                    </div>
                    <div class="tags">
                        <h3>Add some tags</h3>
                        <div class="form-inp">
                            <input type="text" id="tagInput" placeholder="Type something related to your post and hit enter">
                        </div>
                        <div id="tags" class="tags-list">
                            <input style="display: none;" type="text" name="tagArray" id="tagArray"/> 
                        </div>
                    </div>       
                </div>
                <div class="col">
                    <div class="tut-thumb-box">
                        <div class="form-inp">
                            <div class="tut-thumbnail">
                                <img src="" id="thumb-image" alt="">
                            </div>
                            <label class="mt-2"for="tut-thumb-upload"><h4>Choose a Thumbnail</h4></label>
                            <input type="file"  class="pb-4 pt-3" name="thumbnail" id="tut-thumb-upload" onchange="updateThumbnail(this,'thumb-image')">
                        </div>
                    </div>    
                    <div class="form-inp category-box">
                        <label for="Category">Category*</label>
                        <p>Choose the most suitable category to improve discoverability. </p>
                        <select name="Category" id="Category">
                            {foreach from=$categories item=category}
                            <option value="{$category.category}">{$category.category}</option>
                            {/foreach}
                        </select>
                        
                    </div>   
                    <button id="publishButton" type="submit">Publish</button>
                </div>
            </div>
        </form>
    </div>
{/block}