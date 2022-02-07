{extends file="layouts/main.tpl"} {block name="main-body"}
<div class="page-content" id="content">
  <div class="container bpb">
    <div class="your-notes-container">
      <h3>Liked Notes</h3>
      <div class="notes-boxes">
        {if $note_data} {foreach from=$note_data item=note}
        <div class="note-box">
          {if $note.liked}
          <i
            class="like-button far fa-heart active-like-button"
            id="unsave_note"
            data-noteid="{$note.NoteID}"
          ></i>
          {else}
          <i
            class="like-button far fa-heart"
            id="save_note"
            data-noteid="{$note.NoteID}"
          ></i>
          {/if}
          <h4>
            {$note.Note_Title}
            <span>
              <div class="note-menu">
                <ul>
                  <li>Report User</li>
                  <li>Block User</li>
                </ul>
              </div>
              <i class="fas fa-ellipsis-v note-menu-icon"></i>
            </span>
          </h4>
          <p class="noteauthor">By {$note.Username}</p>
          <p class="note-text">{$note.NoteContent}</p>
          <p class="loadmore">Read More</p>
          <p class="mt-4"><i>{$note.age}</i></p>
        </div>
        {/foreach} {else}
        <div class="empty-container">
          <p>
            No Liked notes here! Click on a note's heart icon whenever you want
            to save it - you'll see them all here.
          </p>
        </div>
        {/if}
      </div>
    </div>
  </div>
</div>
{/block}
