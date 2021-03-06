<div class="content">
	<?php foreach($posts as $post): ?>
		<h3><?= h($post->title) ?></h3>
		<p><?= h($post->created->i18nFormat('YYYY年MM月dd日 HH:MM')) ?></p>
		<?= $this->Text->autoParagraph(h($post->description)) ?>
		<a href="/posts/view/<?= $post->id ?>" class="button">記事を読む</a>
		<?= $this->Html->link('記事を読む', [
			'action' => 'view',
			$post->id
		],['class' => 'button']) ?>
		<hr>
	<?php endforeach; ?>

	<?php if($this->paginator->total() > 1): ?>
		<div class="paginator">
			<ul class="pagination">
				<?= $this->Paginator->first('<< 最初') ?>
				<?= $this->Paginator->prev('< 前へ') ?>
				<?= $this->Paginator->numbers() ?>
				<?= $this->Paginator->next('次へ >') ?>
				<?= $this->Paginator->last('最後 >>') ?>
			</ul>
		</div>
	<?php endif; ?>
	
</div>