<? if (User::isLoggedIn()): ?>
	<div class="row">
		<div class="span6">
			<h2>
				Latest Jobs
				:: 1-<?=min(10, $job_count)?> of <?=$job_count?> :: <a href="/jobs">see all</a>
			</h2>
			<?= Controller::byName('job')->renderView('draw_jobs_small', array('jobs' => $jobs)); ?>
		</div>
		<div class="span6">
			<h2>
				Latest Activity
				 :: 1-<?=min(10, $activity_count)?> of <?=$activity_count?> :: <a href="/activity">see all</a>
			</h2>
			<?= Controller::byName('main')->renderView('draw_activities', array('activities' => $activities)); ?>
		</div>
	</div>
	<div class="row">
		<div class="span6">
			<h2>
				My Queues
				 :: 1-<?=min(10, $queue_count)?> of <?=$queue_count?> :: <a href="/queues">see all</a>
			</h2>
			<?= Controller::byName('queue')->renderView('draw_queues', array('queues' => $queues)); ?>
		</div>
		<div class="span6">
			<h2>
				My Bots
				 :: 1-<?=min(10, $bot_count)?> of <?=$bot_count?> :: <a href="/bots">see all</a>
			</h2>
			<?= Controller::byName('bot')->renderView('draw_bots', array('bots' => $bots)); ?>
		</div>
	</div>
<? else: ?>
	Intro text explaining botqueue to first time visitors.
<? endif ?>