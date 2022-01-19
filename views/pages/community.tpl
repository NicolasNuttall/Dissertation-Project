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
      <h3>Community Notes</h3>
      <div class="notes-boxes">
        <div class="note-box">
          <h4>
            Note Heading Note Heading Note Heading Note Heading
            <span>
              <div class="note-menu">
                <ul>
                  <li>Report User</li>
                  <li>Save note</li>
                  <li>Block User</li>
                </ul>
              </div>
              <i class="fas fa-ellipsis-v note-menu-icon"></i>
            </span>
          </h4>
          <p class="noteauthor">By Nicolas Nuttall</p>
          <p class="note-text">
            You completed a 60 minute reading session, wYou completed a 60
            minute reading session,here you reading session, wYou completed a 60
            minute reading session,here you created reading session, wYou
            completed a 60 minute reading session,here you created reading
            session, wYou completed a 60 minute reading session,here you created
            reading session, wYou completed a 60 minute reading session,here you
            created created reading session, wYou completed a 60 minute reading
            session,here you created 21 notes
          </p>
          <p class="loadmore">Read More</p>
        </div>
        <div class="note-box">
          <h4>
            Note Heading Note Heading Note Heading Note Heading
            <span>
              <div class="note-menu">
                <ul>
                  <li>Report User</li>
                  <li>Save note</li>
                  <li>Block User</li>
                </ul>
              </div>
              <i class="fas fa-ellipsis-v note-menu-icon"></i>
            </span>
          </h4>
          <p class="noteauthor">By Nicolas Nuttall<span>12 hours ago</span></p>
          <p class="note-text">
            You completed a 60 minute reading session, wYou completed a 60
            minute reading session,here you reading session, wYou completed a 60
            minute reading session,here you created reading session, wYou
            completed a 60 minute reading session,here you created reading
            session, wYou completed a 60 minute reading session,here you created
            reading session, wYou completed a 60 minute reading session,here you
            created created reading session, wYou completed a 60 minute reading
            session,here you created 21 notes
          </p>
          <p class="loadmore">Read More</p>
        </div>
      </div>
    </div>
  </div>
</div>
{/block}
