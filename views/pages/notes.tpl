{extends file="layouts/main.tpl"} {block name="main-body"}
<div class="page-content" id="content">
  <div class="row mt-5 mx-auto search-bar">
    <i class="fas fa-search"></i>
    <input
      placeholder="Search for a book to add"
      type="text"
      name="search-input"
      id="search-input"
    />
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
    <div class="mini-book-box">
      <div class="mini-book-img">
        <img src="{$thumbnail}" alt="" />
      </div>
      <div class="mini-book-text">
        <h3>{$title} {$year}</h3>
        <p>By {$author}</p>
      </div>
    </div>
    <div class="your-notes-container">
      <h3>Your Notes</h3>
      <div class="notes-boxes">
        {if $notes} {foreach from=$notes item=note}
        <div class="note-box">
          <h4>
            {$note.age}
            <span>
              <div class="note-menu">
                <ul>
                  <li>Edit Note</li>
                  <li>Delete Note</li>
                  <li>Publish Note</li>
                </ul>
              </div>
              <i class="fas fa-ellipsis-v note-menu-icon"></i>
            </span>
          </h4>

          <p class="note-text">{$note.NoteContent}</p>
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
