<!DOCTYPE html>
<html>

<head>
  <script src="./js/scripts-vendor.min.js"></script>
  <script src="./js/scripts.min.js"></script>
  <meta charset="utf-8">
  <title>Promotion - Sharing animation tips for free!</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/styles.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/d96356a49f.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="navbar-body">
  </div>
      <div class="container-fluid p-0 m-0 dash-cont">
        <div class="navigator">
          <div class="f-row alc">
            <h3>Psychology Dashboard <span><i id="nav-drop" class="fas fa-caret-down"></i></span></h3>
            <button class="nav-create">Create +</button>
          </div>
        </div>
        <div class="dashboard"> 
          <div class="dashboard-item search-screen">
            <div class="searchBox">
              <div class="search-box-shadow">
                  <i class="searchIcon fas fa-search"></i>
                  <input id="booksearch" onKeyUp={changeHandler} class="searchInput" type="text" placeholder="Search for a book"/>
              </div>
            </div>
            <div class="dashboard-item-scroll">
              <div class="book-item-container">
                <div class="book-img-container">
                    <img class="book-item-image" src={item.image}/>
                </div>
                <div class="book-item-text">
                    <p class="book-item-title">{item.title} </p>
                    <p class="book-item-authors">{item.authors}</p> 
                    <p class="publishYear">{date}</p>             
                </div>
                <button class="bookshelf-button">+</button>
    
              </div>
            </div>
            
          </div>
          <div class="f-col">
            <div class="dash-item-half bs-container">
              <div class="f-row alc">
                <h2>Psychology Bookshelf <span class="notes-pseudo purp"></span> <span><i class="ml-4 fas fa-book"></i></span></h2>
                <p class="edit-mode">Edit mode</p>
              </div>
              <div class="dashboard-item-scroll bs-grid">
                <div class="bs-item">
                  <img class="bs-item-image" src="https://static.toiimg.com/photo/msid-67586673/67586673.jpg?3918697"/>
                  <div class="bs-info">
                      <p class="bs-item-title">Influence: The psychology of pursuasion</p>
                      <div class="sm-seperator"></div>
                      <p class="bs-author">Dr Cialdini</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="f-row">
              <div class="dash-item-half">
                <h2>Your Notes<span class="ml-3"><i class="fas fa-sticky-note"></i></span><span class="notes-pseudo yellow"></span><span></span></h2>
                <div class="dashboard-item-scroll">
                  <div class="note-item">
                    <p class="note-name">Note Name <span class="note-edited">Last edited 20/12/2021</span></p>
                    <p class="note-summ">This is a brief sumamry of mos amosim oasm omaosmdf of mos amosim oasm omaosmdf of mos amosim oasm omaosmdf of mos amosim oasm omaosmdf</p>
                    <div class="f-row">
                        <button class="note-but note-edit-button">Edit  <span><FontAwesomeIcon class="editPen" icon={faPen}/></span></button>
                        <button class="note-but note-delete-button">Delete <span><FontAwesomeIcon class="deletePen" icon={faTimesCircle}/></span></button>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="dash-item-half">
                    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
  
</body>

</html>