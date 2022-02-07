{extends file="layouts/main.tpl"} {block name="main-body"}
<div class="page-content container-fluid" id="content">
  <div class="bookshelf-top-row">
    <h2>Your Bookshelf</h2>
    <div class="row mb-4 search-bar">
      <i class="fas fa-search"></i>
      <input
        placeholder="Search for a book to add"
        type="text"
        name="search-input"
        id="search-input"
      />
    </div>
    <!-- <button id="create-custome-item-button" class="green-button">
      Create Custom Item
    </button> -->
  </div>
  <div class="row">
    <div class="bookshelf-grid">
      {if $bookshelf} {foreach from=$bookshelf item=book}
      <div class="bs-container-container">
        <a
          href="/Readie/summary/{$book.BookID}"
          class="bookshelf-item-container"
        >
          <div class="book-item-front">
            <img src="{$book.BookImage}" alt="" />
            <div class="front-info">
              <h2>{$book.BookTitle}</h2>
              <p>By {$book.Authors}</p>
            </div>
          </div>
          <div class="book-item-back">
            <div class="book-stats">
              <p class="notes-number">
                <span><i class="fas fa-sticky-note"></i></span>
                {$book.notes.amount} Notes
              </p>
              <p class="reading-time">
                <span><i class="fas fa-clock"></i></span>
                {$book.timer.hours}h {$book.timer.minutes}m
                {$book.timer.seconds}s
              </p>
            </div>
          </div>
          <div class="background"></div>
        </a>
        <div class="book-buttons">
          <a href="/Readie/study/{$book.BookID}">Study</a>
        </div>
      </div>
      {/foreach} {else}
      <div class="empty-container">
        <p>
          There are no books on your shelf, use the search bar to find some and
          add to your collection.
        </p>
      </div>
      {/if}
    </div>
  </div>
</div>
{/block}
