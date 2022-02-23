{extends file="layouts/main.tpl"} {block name="main-body"}

<div class="page-content mt-5" id="content">
  <div class="container">
    <div class="ml-auto mr-4 row mb-4 search-bar">
      <i class="fas fa-search"></i>
      <input
        placeholder="Search for a book to add"
        type="text"
        name="search-input"
        id="search-input"
      />
    </div>
    <div id="studyJournal" class="study-journal">
      <h3>Study Journal</h3>
      <p>
        Defining and writing out your goals has proved to be an effective way of
        increasing motivation, use this page to do as such.
      </p>
      <label for="q1"
        >Think about and write out the questions you would like answers
        to.</label
      >
      <input type="text" name="q1" id="q1" />
      <label for="q2"
        >Now, briefly think about how you will benefit from learning these
        answers?
      </label>
      <textarea name="q2" id="q2"></textarea>
      <button id="journal-submit">Submit Entry</button>
    </div>

    <div class="journal-archive">
      <button id="archive-toggle">View Journal Archive</button>
      <div class="journal-submissions">
        {if $archive} {foreach from=$archive item=journ}
        <div class="submission" id="{$journ.journal_entry_id}">
          <div class="content">
            <h4>
              Think about and write out the questions you would like answers to
            </h4>
            <p class="{$journ.journal_entry_id}">{$journ.q1}</p>
            <h4>
              Now, briefly think about how you will benefit from learning these
              answers?
            </h4>
            <p class="{$journ.journal_entry_id}2">{$journ.q2}</p>
          </div>
          <div class="journal-menu">
            <ul>
              <li>
                <button
                  class="edit-journal"
                  data-journid="{$journ.journal_entry_id}"
                >
                  Edit Entry
                </button>
              </li>
              <li>
                <button
                  class="delete-journal"
                  data-journid="{$journ.journal_entry_id}"
                >
                  Delete Entry
                </button>
              </li>
            </ul>
          </div>
          <i class="fas fa-ellipsis-v note-menu-icon"></i>
        </div>
        {/foreach} {else}
        <div class="empty-container">
          <p>No Journal entries</p>
        </div>
        {/if}
      </div>
    </div>
  </div>
</div>

{/block}
