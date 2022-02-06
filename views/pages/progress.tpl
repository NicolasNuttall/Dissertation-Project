{extends file="layouts/main.tpl"} {block name="main-body"}

<div class="page-content">
  <div class="progress-page container">
    <h3 class="">
      Goals & Progress <span><button id="edit-goal">Edit Goals</button></span>
    </h2>
    <p class="mb-5">Set and keep track of your weekly reading goals. Try to be realistic.</p>
    <div class="set-goal">
      <div class="preset-goals mb-5">
        <div class="goal-option" data-goalint="1800">
          <p>30 minutes</p>
        </div>
        <div class="goal-option" data-goalint="3600">
          <p>1 hour</p>
        </div>
        <div class="goal-option" data-goalint="10800">
          <p>3 hours</p>
        </div>
        <div class="goal-option" data-goalint="252000">
          <p>7 hours</p>
        </div>
      </div>
      <label for="goalNumber" >Add Custom Goal ( hours )</label>
      <div class="custom-goal-set">
        <input placeholder="Full numbers and decimals are allowed" type="number" id="goalNumber" />
      </div>
      <button id="setgoal" class="mt-4 custom-goal-button">Save</button>
    </div>
    <div class="goal-progress-container mt-5">
      <p>{$progress.ga} / {$progress.gl} Minutes</p>
      <div class="empty-goal-bar">
        <div style="width:{$progress.per}%;" class="goal-bar-fill"></div>
      </div>
    </div>
  </div>
</div>

{/block}
