<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\BonusRepository;
use App\Repositories\MemberRepository;

class BonusController extends Controller
{
	/**
     * The BonusRepository instance.
     *
     * @var \App\Repositories\BonusRepository
     */
    protected $BonusRepository;

    /**
     * The MemberRepository instance.
     *
     * @var \App\Repositories\MemberRepository
     */
    protected $MemberRepository;

    public function __construct(
        BonusRepository $BonusRepository,
        MemberRepository $MemberRepository
    ) {
        $this->middleware('admin');
        $this->BonusRepository = $BonusRepository;
        $this->MemberRepository = $MemberRepository;
    }

    /**
     * Datatable member admin
     * @return [type] [description]
     */
    public function getList ($type) {
        return $this->BonusRepository->findAll(true, $type);
    }

    /**
     * Get edit Bonus
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getEdit ($id) {
        if (!$model = $this->BonusRepository->findById(trim($id), trim(\Input::get('type')))) {
            return redirect()->back()->with('flashMessage', [
                'class' =>  'danger',
                'message' => 'Bonus not found.'
            ]);
        }
        return view('back.bonus.edit')->with('model', $model);
    }

    /**
     * Add statement
     * @return json
     */
    public function postAdd () {
        $data = \Input::get('data');
        if (!$target = $this->MemberRepository->findByUsername(trim($data['username']))) {
            return \Response::json([
                'type' => 'error',
                'message' => 'Member not found.'
            ]);
        }
        $model = null;
        switch ($data['type']) {
            case 'direct':
                $model = new \App\Models\BonusDirect;
                break;

            case 'override':
                $model = new \App\Models\BonusOverride;
                break;

            case 'pairing':
                $model = new \App\Models\BonusPairing;
                break;

            case 'group':
                $model = new \App\Models\BonusGroup;
                break;
            
            default:
                $model = null;
                break;
        }

        if (!is_null($model)) {
            try {
                $this->BonusRepository->saveModel($model, [
                    'member_id' => $target->id,
                    'username' => $target->username,
                    'amount_cash' => (float) $data['cash'],
                    'amount_promotion' => (float) $data['promotion'],
                    'total' => (float) $data['total']
                ]);
            } catch (\Exception $e) {
                return \Response::json([
                    'type' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }

        return \Response::json([
            'type'  =>  'success',
            'message' => 'Bonus statement added.'
        ]);
    }

    /**
     * Update shares settings
     * @param integer $id
     * @return [type] [description]
     */
    public function postUpdate ($id) {
        $data = \Input::get('data');
        if (!$model = $this->BonusRepository->findById(trim($id), trim(\Input::get('type')))) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  'Bonus not found.'
            ]);
        }

        $this->BonusRepository->update($model, $data);

        return \Response::json([
            'type'  =>  'success',
            'message'   =>  'Bonus #' . $model->id . ' updated.'
        ]);
    }

    /**
     * Remove bonus statement
     * @param string $type
     * @param integer $id
     * @return json
     */
    public function postDelete ($type, $id) {
        switch ($type) {
            case 'direct':
                $model = new \App\Models\BonusDirect;
                break;

            case 'override':
                $model = new \App\Models\BonusOverride;
                break;

            case 'pairing':
                $model = new \App\Models\BonusPairing;
                break;

            case 'group':
                $model = new \App\Models\BonusGroup;
                break;
            
            default:
                $model = null;
                break;
        }

        if (is_null($model)) {
            return \Response::json([
                'type' => 'warning',
                'message' => 'Bonus type error.'
            ]);
        }

        $model->where('id', trim($id))->delete();

        return \Response::json([
            'type' => 'success',
            'message' => 'Bonus removed.'
        ]);
    }
}