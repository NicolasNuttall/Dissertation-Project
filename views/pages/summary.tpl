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
  <div class="book-header-container">
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

  <div class="container bookPageBody bpb">
    <div class="row about-page">
      <div class="col-3 bcc-container">
        <div class="bcc">
          <div class="book-cover-container">
            <img src="{$book_data.usedImage}" alt="" />
          </div>
          <div class="d-flex flex-column">
            {if $is_added}
            <button class="green-button saved" id="unsave" data-bookid="{$id}">
              Remove
            </button>
            {else}
            <button class="green-button save" id="save" data-bookid="{$id}">
              Save
            </button>
            {/if}
            <div class="stats">
              <a class="stat">
                <i class="fas fa-clock"></i>
                <p>
                  {$book_data.timer.hours}h {$book_data.timer.minutes}m
                  {$book_data.timer.seconds}s
                </p>
              </a>
              <a class="stat">
                <i class="fas fa-sticky-note"></i>
                <p>{$book_data.notes.amount} Notes</p>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col pl-5">
        <div class="book-details">
          <h3>{$book_data.title} ({$book_data.year})</h3>
          <p class="author-name">By {$book_data.authors}</p>
          <div class="book-description">{$book_data.description}</div>
          <p class="loadmore">Read More</p>
        </div>
        <h3 class="recent-heading">
          Recent Notes<span><a class="loadmore" href="">View All</a></span>
        </h3>
        <div class="recent-activity-container">
          {if $notes} {foreach from=$notes item=note}
          <div class="recent-activity" id="{$note.NoteID}">
            <h4>
              {$note.age}
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
</div>
{/block}
