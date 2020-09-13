<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Biditems Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BidinfoTable&\Cake\ORM\Association\HasMany $Bidinfo
 * @property \App\Model\Table\BidrequestsTable&\Cake\ORM\Association\HasMany $Bidrequests
 *
 * @method \App\Model\Entity\Biditem newEmptyEntity()
 * @method \App\Model\Entity\Biditem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Biditem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Biditem get($primaryKey, $options = [])
 * @method \App\Model\Entity\Biditem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Biditem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Biditem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Biditem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Biditem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Biditem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Biditem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Biditem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Biditem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BiditemsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('biditems');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasOne('Bidinfo', [
            'foreignKey' => 'biditem_id',
        ]);
        $this->hasMany('Bidrequests', [
            'foreignKey' => 'biditem_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name', '名前を入力してください');

		//↓↓↓↓↓↓↓↓【機能追加】商品詳細用のバリデーション↓↓↓↓↓↓↓↓
		$validator
			->requirePresence('detail', 'create')
			->notEmpty('detail', '詳細を入力してください');

		//↓↓↓↓↓↓↓↓【機能追加】商品画像用のバリデーション↓↓↓↓↓↓↓↓
		$validator
			->requirePresence('image_file', 'create') //項目が存在するか確認
			->notEmpty('image_file', 'ファイルをアップロードしてください') //空を許可しない
			->add('image_file', 'file',[
				'rule' => ['mimeType', ['image/jpg', 'image/png', 'image/jpeg']],
				'message' => 'jpg、png、jpegのいずれかでアップロードしてください',
			]); //アップロードできる拡張子を制限

        $validator
            ->boolean('finished')
            ->requirePresence('finished', 'create')
            ->notEmptyString('finished');

        $validator
            ->dateTime('endtime')
            ->requirePresence('endtime', 'create')
            ->notEmptyDateTime('endtime');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
