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
    <button id="create-custome-item-button" class="green-button">
      Create Custom Item
    </button>
  </div>
  <div class="row">
    <div class="bookshelf-grid">
      <div class="bookshelf-item-container">
        <div class="book-item-front">
          <img src="./images/71wdVdp0ncL.jpg" alt="" />
          <div class="front-info">
            <h2>Book Title</h2>
            <p>By Author name</p>
          </div>
        </div>
        <div class="book-item-back">
          <div class="book-stats">
            <p class="notes-number">
              <span><i class="fas fa-sticky-note"></i></span> 21 Notes
            </p>
            <p class="reading-time">
              <span><i class="fas fa-clock"></i></span> 00:32:23
            </p>
          </div>
          <div class="d-flex book-buttons">
            <button class="green-button">Study</button>
          </div>
        </div>
        <div class="background"></div>
      </div>
      <div class="bookshelf-item-container">
        <div class="book-item-front">
          <img src="./images/book.jpg" alt="" />
          <div class="front-info">
            <h2>Book Title</h2>
            <p>By Author name</p>
          </div>
        </div>
        <div class="book-item-back">
          <div class="book-stats">
            <p class="notes-number">
              <span><i class="fas fa-sticky-note"></i></span> 21 Notes
            </p>
            <p class="reading-time">
              <span><i class="fas fa-clock"></i></span> 00:32:23
            </p>
          </div>
          <div class="d-flex book-buttons">
            <button>Study</button>
          </div>
        </div>
        <div class="background"></div>
      </div>
      <div class="bookshelf-item-container">
        <div class="book-item-front">
          <img src="./images/book.jpg" alt="" />
          <div class="front-info">
            <h2>Book Title</h2>
            <p>By Author name</p>
          </div>
        </div>
        <div class="book-item-back">
          <div class="book-stats">
            <p class="notes-number">
              <span><i class="fas fa-sticky-note"></i></span> 21 Notes
            </p>
            <p class="reading-time">
              <span><i class="fas fa-clock"></i></span> 00:32:23
            </p>
          </div>
          <div class="d-flex book-buttons">
            <button>Study</button>
          </div>
        </div>
        <div class="background"></div>
      </div>
      <div class="bookshelf-item-container">
        <div class="book-item-front">
          <img src="./images/book.jpg" alt="" />
          <div class="front-info">
            <h2>Book Title</h2>
            <p>By Author name</p>
          </div>
        </div>
        <div class="book-item-back">
          <div class="book-stats">
            <p class="notes-number">
              <span><i class="fas fa-sticky-note"></i></span> 21 Notes
            </p>
            <p class="reading-time">
              <span><i class="fas fa-clock"></i></span> 00:32:23
            </p>
          </div>
          <div class="d-flex book-buttons">
            <button>Study</button>
          </div>
        </div>
        <div class="background"></div>
      </div>
      <div class="bookshelf-item-container">
        <div class="book-item-front">
          <img src="./images/book.jpg" alt="" />
          <div class="front-info">
            <h2>Book Title</h2>
            <p>By Author name</p>
          </div>
        </div>
        <div class="book-item-back">
          <div class="book-stats">
            <p class="notes-number">
              <span><i class="fas fa-sticky-note"></i></span> 21 Notes
            </p>
            <p class="reading-time">
              <span><i class="fas fa-clock"></i></span> 00:32:23
            </p>
          </div>
          <div class="d-flex book-buttons">
            <button>Study</button>
          </div>
        </div>
        <div class="background"></div>
      </div>
    </div>
  </div>
</div>
{/block}
