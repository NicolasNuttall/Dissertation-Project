{extends file="layouts/main.tpl"}
{block name="body"}
    <div class="profile-edit-form">
        <form action="" method="POST" name="profile_edit" enctype="multipart/form-data" class="profile-edit mx-auto my-auto">
            <h1>Edit your profile</h1>
            <div class=" profile-image-upload"> 
                <label for="avatar" id="avatar-upload" class="avatar-upload" style="background-image:url(/Promotion/images/avatars/{$user_data.avatar_img});"></label>
                <input onchange="AvatarEdit(this,'avatar-upload')" style="display: none;" id="avatar" name="avatar" type="file">
                <label id="banner-upload" for="banner" class="banner-upload" style="background-image:url(/Promotion/images/banners/{$user_data.banner_img});"></label>
                <input onchange="AvatarEdit(this,'banner-upload')" style="display:none;" id="banner" name="banner" type="file">
            </div>
            <div class="edit-field"> 
                <label for="username">Username</label>
                <p><i>Username is not editable*</i></p>
                <input  type="text"id="username" maxlength="20" name="username" value="{$user_data.username}" disabled>
            </div>
            <div class="edit-field"> 
                <label for="Biography">Biography</label>
                <textarea type="text" maxlength="200" rows="4" id="Biography" class="expandText" name="Biography">{$user_data.biography}</textarea>
            </div>
            <div class="edit-field"> 
                <label for="Location">Location</label>
                <input type="text" id="Location" maxlength="20" name="Location" value="{$user_data.location}">
            </div>
            <button type="submit" name="profile_edit" value="1">Save Changes</button>
            <a href="/Promotion/profile/{$user_data.username}">Back to Profile</a>
            {if $saved}
                <div class="alert alert-success mt-2" role="alert">
                    {$saved}
                </div>
            {/if}
        </form>
    </div>
{/block}