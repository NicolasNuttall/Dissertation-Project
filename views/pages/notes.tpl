{extends file="layouts/main.tpl"} {block name="main-body"}
<div class="page-content" id="content">
  <div class="container top-bar-book-page mx-auto row d-flex flex-row">
    <div class="mini-book-box col-lg-6 mb-sm-0">
      <div class="mini-book-img">
        <img src="{$book_data.usedImage}" alt="" />
      </div>
      <div class="mini-book-text">
        <h3>{$book_data.title} ({$book_data.year})</h3>
        <p>By {$book_data.authors}</p>
      </div>
    </div>
    <div class="search-bar col">
      <i class="fas fa-search"></i>
      <input
        placeholder="Search for a book "
        type="text"
        name="search-input"
        id="search-input"
      />
    </div>
  </div>
  <div class="book-header-container mb-2">
    <div class="container bpb">
      <div class="row book-header">
        <div class="book-nav">
          <ul>
            <li><a href="/Readie/summary/{$id}">Summary</a></li>
            <li><a href="/Readie/study/{$id}">Study</a></li>
            <li><a href="/Readie/notes/{$id}">Notes</a></li>
            <li><a href="/Readie/community/{$id}">Community</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="container bpb">
    <div class="your-notes-container">
      <h3>Your Notes</h3>
      <div class="notes-boxes">
        {if $notes} {foreach from=$notes item=note}
        <div class="note-box" id="{$note.NoteID}">
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
          <p>{$note.age}</p>
          <p class="{$note.NoteID} note-text">{$note.NoteContent}</p>
          <p class="loadmore">Read More</p>
        </div>
        {/foreach} {else}
        <h2>No Notes</h2>
        {/if}
      </div>
    </div>
  </div>
</div>
{/block}
