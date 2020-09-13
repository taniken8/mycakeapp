<h2>ミニオークション</h2>
<h3>※出品されている商品</h3>
<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th class="main" scope="col"><?=$this->Paginator->sort('name') ?></th>
			<th class="main" scope="col"><?=$this->Paginator->sort('finished') ?></th>
			<th class="main" scope="col"><?=$this->Paginator->sort('endtime') ?></th>
			<th class="main" scope="col"><?=$this->Paginator->sort('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($auction as $biditem): ?>
		<tr>
			<td><?=h($biditem->name) ?></td>
			<!-- finishedが「１」（true）であれば、Finishedを、「０」(false)であれば ''（空白）を返す（三項演算子）-->
			<td><?=h($biditem->finished ? 'Finished':'') ?></td>
			<td><?=h($biditem->endtime) ?></td>
			<td class="actions"><?= $this->Html->link(__('View'), ['action' => 'view', $biditem->id]) ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<div class="paginator">
	<ul class="pagination">
		<?=$this->Paginator->first('<<' . __('first')) ?>
		<?=$this->Paginator->prev('<' . __('previous')) ?>
		<?=$this->Paginator->numbers() ?>
		<?=$this->Paginator->next(__('next') . '>') ?>
		<?=$this->Paginator->last(__('last') . '>>') ?>
	</ul>
</div>

<h3>※ユーザーからの評価</h3>
<?php if ($bidreviews) : ?>
		<table>
			<tr>
				<th><?= __('あなたを評価したユーザー') ?></th>
				<th><?= __('Rate') ?></th>
				<th><?= __('Comment') ?></th>
				<th><?= __('Created') ?></th>
			</tr>
			<?php foreach ($bidreviews->toArray() as $bidreview) : ?>
			<tr>
				<td><?= h($bidreview->user->username) ?></td>
				<td><?= h($bidreview->rate) ?></td>
				<td><?= h($bidreview->comment) ?></td>
				<td><?= h($bidreview->created) ?></td>
			</tr>
			<?php endforeach; ?>

			<tr>
				<th><?= __('ユーザー評価の平均') ?></th>
			</tr>
			<td>
				<p><?php echo round($bidreviewsAvg, 1); ?></p>
			</td>
		</table>
<?php endif; ?>