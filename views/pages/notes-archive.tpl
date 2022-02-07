{extends file="layouts/main.tpl"} {block name="main-body"}
<div class="bpb page-content">
  <div class="your-notes-container container">
    <h3>All Notes</h3>
    <p>This page contains all the notes you've created using Readie.</p>
    <div class="notes-boxes">
      {if $notes} {foreach from=$notes item=note }
      <div class="note-box" id="{$note.NoteID}">
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
        <h4 class="x{$note.NoteID}">
          {$note.Note_Title}
          <span>
            <div class="note-menu">
              <ul>
                <li>
                  <button class="edit-note" data-noteid="{$note.NoteID}">
                    Edit Note
                  </button>
                </li>
                <li>
                  <button class="publish-note" data-noteid="{$note.NoteID}">
                    Publish Note
                  </button>
                </li>
                <li>
                  <button class="delete-note" data-noteid="{$note.NoteID}">
                    Delete Note
                  </button>
                </li>
              </ul>
            </div>
            <i class="fas fa-ellipsis-v note-menu-icon"></i>
          </span>
        </h4>
        <p class="noteauthor">By {$note.Username}</p>
        <p class="{$note.NoteID} note-text">{$note.NoteContent}</p>
        <p class="loadmore">Read More</p>
        <p class="mt-4"><i>{$note.age}</i></p>
        <a href="/Readie/summary/{$note.BookID}" class="book-info">
          <img src="{$note.bookinfo.BookImage}" alt="" />
        </a>
      </div>
      {/foreach} {else}
      <div class="empty-container">
        <p>No notes yet - use a book's study section to create some.</p>
      </div>
      {/if}
    </div>
  </div>
</div>
{/block}
