<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\TransferRepository;
use App\Repositories\MemberRepository;

class TransferController extends Controller
{
	/**
     * The SharesRepository instance.
     *
     * @var \App\Repositories\TransferRepository
     */
    protected $TransferRepository;

    /**
     * The MemberRepository instance.
     *
     * @var \App\Repositories\MemberRepository
     */
    protected $MemberRepository;

    public function __construct(
        TransferRepository $TransferRepository,
        MemberRepository $MemberRepository
    ) {
        $this->middleware('admin');
        $this->TransferRepository = $TransferRepository;
        $this->MemberRepository = $MemberRepository;
    }

    /**
     * Datatable member admin
     * @return [type] [description]
     */
    public function getList () {
        return $this->TransferRepository->findAll(true);
    }
    
    /**
     * Get edit Transfer
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getEdit ($id) {
        if (!$model = $this->TransferRepository->findById(trim($id))) {
            return redirect()->back()->with('flashMessage', [
                'class' =>  'danger',
                'message' => 'Transfer not found.'
            ]);
        }
        return view('back.transfer.edit')->with('model', $model);
    }

    /**
     * Add statement
     * @return json
     */
    public function postAdd () {
        $data = \Input::get('data');
        if (!$from = $this->MemberRepository->findByUsername(trim($data['from']))) {
            return \Response::json([
                'type' => 'error',
                'message' => 'Member not found.'
            ]);
        }

        if (!$to = $this->MemberRepository->findByUsername(trim($data['to']))) {
            return \Response::json([
                'type' => 'error',
                'message' => 'Member not found.'
            ]);
        }

        try {
            $this->TransferRepository->store([
                'from_member_id' => $from->id,
                'from_username' => $from->username,
                'to_member_id' => $to->id,
                'to_username' => $to->username,
                'type' => $data['type'],
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
            'message' => 'Transfer statement added.'
        ]);
    }

    /**
     * Update shares settings
     * @param integer $id
     * @return [type] [description]
     */
    public function postUpdate ($id) {
        $data = \Input::get('data');
        if (!$model = $this->TransferRepository->findById(trim($id))) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  'Transfer not found.'
            ]);
        }

        $this->TransferRepository->update($model, $data);

        return \Response::json([
            'type'  =>  'success',
            'message'   =>  'Transfer #' . $model->id . ' updated.'
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
