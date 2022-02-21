{extends file="layouts/main.tpl"} {block name="main-body"}

<div class="page-content browse-page" id="content">
  <div class="container bpb">
    <div class="mt-5">
      <h3 class="mt-4">Your recomended</h3>
      <p>Here's what we think you'll like, based on your recent reading</p>
      <div class="mt-4 book-row">
        {foreach from=$authors item=x}
        <a href="/Readie/summary/{$x.id}" class="browse-item">
          <div class="front">
            <img src="{$x.usedImage}" alt="" />
          </div>
          <div class="back">
            <h4>{$x.title}</h4>
            <p>By {$x.authors}</p>
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
        <button class="shuffle" id="shuffle" name="shuffle">Shuffle</button>
      </div>
    </div>
  </div>
</div>
{/block}
