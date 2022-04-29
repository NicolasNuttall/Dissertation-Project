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
  <div class="container study-body bpb">
    <div class="study-section">
      <div class="sticky-box">
        <div class="study-top">
          <h4>Create a Note</h4>
          <div class="timer-changer" data-time="{$book_data.sec}">
            <div class="timer-labels">
              <p>H</p>
              <p>M</p>
              <p>S</p>
            </div>
            <input
              placeholder="00"
              min="0"
              max="24"
              type="number"
              name=""
              id="hour"
              class="timer-input"
            />
            <input
              placeholder="00"
              min="0"
              max="60"
              type="number"
              name=""
              id="min"
              class="timer-input"
            />
            <input
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
        <div class="note-creation-box" data-noteno="{$book_data.notes.amount}">
          <textarea
            class="expandText"
            name="noteText"
            id="noteText"
            cols="1"
            rows="1"
            maxlength="2000"
            placeholder="What did you learn? Press Ctrl + Enter to fast submit"
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
      <div class="study-notes-container"></div>
    </div>
  </div>
</div>
{/block}
