{extends file="layouts/main.tpl"} {block name="main-body"}

<div class="page-content browse-page" id="content">
  <div class="container bpb">
    <div class="mt-5">
      <div class="ml-auto mr-4 row mb-4 search-bar">
        <i class="fas fa-search"></i>
        <input
          placeholder="Search for a book to add"
          type="text"
          name="search-input"
          id="search-input"
        />
      </div>
      <h3 class="mt-4">Your recomended</h3>
      <p>Here's what we think you'll like, based on your recent reading</p>
      <button class="green-button shuffle" id="shuffle" name="shuffle">
        Shuffle
      </button>
      <img
        class="loading-icon"
        src="/Readie/images/Loadingicon_1.gif"
        alt="loading icon"
      />
      <div class="mt-4 book-row">
        {foreach from=$authors item=x}
        <a href="/Readie/summary/{$x.id}" class="browse-item">
          <div class="front">
            <img src="{$x.usedImage}" alt="" />
          </div>
          <div class="back">
            <h4>{$x.title}</h4>
            <p>{$x.authors}</p>
          </div>
        </a>
        {/foreach} {foreach from=$recomended item=x}
        <a href="/Readie/summary/{$x.id}" class="browse-item">
          <div class="front">
            <img src="{$x.usedImage}" alt="" />
          </div>
          <div class="back">
            <h4>{$x.title}</h4>
            <p>{$x.authors}</p>
          </div>
        </a>
        {/foreach}
      </div>
    </div>
  </div>
</div>
{/block}
