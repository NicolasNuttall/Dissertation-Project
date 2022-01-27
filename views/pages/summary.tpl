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
                <p>2h 30m</p>
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
          <div class="recent-activity">
            <h4>
              23 Days ago...
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

            <p class="note-text">
              You completed a 60 minute reading session, wYou completed a 60
              minute reading session,here you reading session, wYou completed a
              60 minute reading session,here you created reading session, wYou
              completed a 60 minute reading session,here you created reading
              session, wYou completed a 60 minute reading session,here you
              created reading session, wYou completed a 60 minute reading
              session,here you created created reading session, wYou completed a
              60 minute reading session,here you created 21 notes
            </p>
            <p class="loadmore">Read More</p>
          </div>
          <div class="recent-activity">
            <h4>
              23 Days ago...
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

            <p class="note-text">
              You completed a 60 minute reading session, wYou completed a 60
              minute reading session,here you reading session, wYou completed a
              60 minute reading session,here you created reading session, wYou
              completed a 60 minute reading session,here you created reading
              session, wYou completed a 60 minute reading session,here you
              created reading session, wYou completed a 60 minute reading
              session,here you created created reading session, wYou completed a
              60 minute reading session,here you created 21 notes
            </p>
            <p class="loadmore">Read More</p>
          </div>
          <div class="recent-activity">
            <h4>
              23 Days ago...
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

            <p class="note-text">
              You completed a 60 minute reading session, wYou completed a 60
              minute reading session,here you reading session, wYou completed a
              60 minute reading session,here you created reading session, wYou
              completed a 60 minute reading session,here you created reading
              session, wYou completed a 60 minute reading session,here you
              created reading session, wYou completed a 60 minute reading
              session,here you created created reading session, wYou completed a
              60 minute reading session,here you created 21 notes
            </p>
            <p class="loadmore">Read More</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{/block}
