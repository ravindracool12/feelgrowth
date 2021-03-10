<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\WithdrawRepository;
use App\Repositories\MemberRepository;

class WithdrawController extends Controller
{
	/**
     * The SharesRepository instance.
     *
     * @var \App\Repositories\WithdrawRepository
     */
    protected $WithdrawRepository;

    /**
     * The MemberRepository instance.
     *
     * @var \App\Repositories\MemberRepository
     */
    protected $MemberRepository;

    public function __construct(
        WithdrawRepository $WithdrawRepository,
        MemberRepository $MemberRepository
    ) {
        $this->middleware('admin');
        $this->WithdrawRepository = $WithdrawRepository;
        $this->MemberRepository = $MemberRepository;
    }

    /**
     * Datatable member admin
     * @return object
     */
    public function getList () {
        return $this->WithdrawRepository->findAll(true);
    }

    /**
     * Detail for modal
     * @param integer $id
     * @return html
     */
    public function getShowModal ($id) {
        if (!$model = $this->WithdrawRepository->findById(trim($id))) {
            return 'Withdraw not found.';
        }
        return view('back.withdraw.show')->with('model', $model);
    }

    /**
     * Get edit Withdraw
     * @param  integer $id
     * @return html
     */
    public function getEdit ($id) {
        if (!$model = $this->WithdrawRepository->findById(trim($id))) {
            return redirect()->back()->with('flashMessage', [
                'class' =>  'danger',
                'message' => 'Withdraw not found.'
            ]);
        }
        return view('back.withdraw.edit')->with('model', $model);
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

        try {
            $this->WithdrawRepository->store([
                'member_id' => $target->id,
                'username' => $target->username,
                'status' => $data['status'],
                'amount' => (float) $data['amount']
            ]);
        } catch (\Exception $e) {
            return \Response::json([
                'type' => 'error',
                'message' => $e->getMessage()
            ]);
        }

        return \Response::json([
            'type'  =>  'success',
            'message' => 'Withdraw statement added.'
        ]);
    }

    /**
     * Update shares settings
     * @param integer $id
     * @return json
     */
    public function postUpdate ($id) {
        $data = \Input::get('data');
        if (!$model = $this->WithdrawRepository->findById(trim($id))) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  'Withdraw not found.'
            ]);
        }

        $this->WithdrawRepository->update($model, $data);

        return \Response::json([
            'type'  =>  'success',
            'message'   =>  'Withdraw #' . $model->id . ' updated.'
        ]);
    }

    /**
     * Remove transfer statement
     * @param integer $id
     * @return json
     */
    public function postDelete ($id) {
        $model = new \App\Models\Transfer;
        $model->where('id', trim($id))->delete();

        return \Response::json([
            'type' => 'success',
            'message' => 'Transfer data removed.'
        ]);
    }
}
