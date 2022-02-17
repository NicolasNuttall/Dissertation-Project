{extends file="layouts/main.tpl"} {block name="main-body"}

<div class="page-content" id="content">
  <div class="container bpb">
    {foreach from=$recomended item=x}
    <p>{$x.title}</p>
    {/foreach}
  </div>
</div>
{/block}
