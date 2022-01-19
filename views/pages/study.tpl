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
  <div class="container study-body bpb">
    <div class="mini-book-box">
      <div class="mini-book-img">
        <img src="{$thumbnail}" alt="" />
      </div>
      <div class="mini-book-text">
        <h3>{$title} {$year}</h3>
        <p>By {$author}</p>
      </div>
    </div>
    <div class="study-section">
      <div class="sticky-box">
        <div class="study-top">
          <h4>Create a Note</h4>
          <div class="timer-changer">
            <div class="timer-labels">
              <p>H</p>
              <p>M</p>
              <p>S</p>
            </div>
            <input
              placeholder="00"
              value="00"
              min="0"
              max="24"
              type="number"
              name=""
              id="hour"
              class="timer-input"
            />
            <input
              value="05"
              placeholder="00"
              min="0"
              max="60"
              type="number"
              name=""
              id="min"
              class="timer-input"
            />
            <input
              value="10"
              placeholder="00"
              min="0"
              max="60"
              type="number"
              name=""
              id="sec"
              class="timer-input"
            />
            <button class="timer-button" id="timerStart">
              <i class="fas fa-play-circle timer-start"></i>
            </button>
            <button class="timer-button" id="timerStop">
              <i class="fas fa-stop-circle timer-stop"></i>
            </button>
          </div>
        </div>
        <div class="note-creation-box">
          <textarea
            class="expandText"
            name="noteText"
            id="noteText"
            cols="1"
            rows="1"
          ></textarea>
          <button
            class="submit-note green-button"
            type="button"
            data-bookid="{$id}"
            id="createNote"
          >
            Submit
          </button>
        </div>
      </div>
      <div class="study-notes-container">
        <div class="study-note-item">
          <h4>
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
          <p>
            Something About this Something about that I think that his something
            about that is really interesting and worth making a note of...
          </p>
        </div>
        <div class="study-note-item">
          <h4>
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
          <p>
            Something About this Something about that I think that his something
            about that is really interesting and worth making a note of...
          </p>
        </div>
        <div class="study-note-item">
          <h4>
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
          <p>
            Something About this Something about that I think that his something
            about that is really interesting and worth making a note of...
          </p>
        </div>
        <div class="study-note-item">
          <h4>
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
          <p>
            Something About this Something about that I think that his something
            about that is really interesting and worth making a note of...
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
{/block}
