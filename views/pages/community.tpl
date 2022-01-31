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
      <h3>Community Notes</h3>
      <div class="notes-boxes">
        {foreach from=$notes item=note }
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
        {/foreach}
      </div>
    </div>
  </div>
</div>
{/block}
