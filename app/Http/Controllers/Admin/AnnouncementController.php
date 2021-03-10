<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\AnnouncementRepository;

class AnnouncementController extends Controller
{
    /**
     * The AnnouncementRepository instance.
     *
     * @var \App\Repositories\AnnouncementRepository
     */
    protected $AnnouncementRepository;

    /**
     * Create a new AnnouncementController instance.
     *
     * @param \App\Repositories\AnnouncementRepository $AnnouncementRepository
     * @return void
     */
    public function __construct(AnnouncementRepository $AnnouncementRepository) {
        $this->AnnouncementRepository = $AnnouncementRepository;
        $this->middleware('admin');
    }

    /**
     * Datatable List
     * @return [type] [description]
     */
    public function getList () {
        return $this->AnnouncementRepository->getAdminList();
    }

    /**
     * Edit Announcement Page
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getEdit ($id) {
        if (!$model = $this->AnnouncementRepository->findById($id)) {
            return redirect()->back()->with('flashMessage', [
                'class' => 'danger',
                'message' => 'Data not found.'
            ]);
        }

        return view('back.announcement.edit')->with('model', $model);
    }

    /**
     * Create Announcement
     * @return [type] [description]
     */
    public function postCreate () {
        $data = \Input::get('data');
        if (isset($data['files'])) unset($data['files']);

        try {
            $this->AnnouncementRepository->store($data);
        } catch (\Exception $e) {
            return \Response::json([
                'type' => 'error',
                'message' => $e->getMessage()
            ]);
        }

        \Cache::forget('announcement.new');

        return \Response::json([
            'type' => 'success',
            'message' => 'Announcement created.'
        ]);
    }

    /**
     * Submit preview request
     * @param Request $req
     * @return json
     */
    public function previewSubmit (Request $req) {
        $data = \Input::get('data');
        $req->session()->put('announcement.preview', $data);
        return \Response::json([
            'type' => 'success',
            'message' => 'Redirecting you to new window..',
            'redirect' => route('admin.announcement.preview')
        ]);
    }

    /**
     * Get the HTML for preview
     * @param  Request $req
     * @return html
     */
    public function preview (Request $req) {
        $data = $req->session()->pull('announcement.preview', []);
        return view('back.announcement.preview')->with('data', $data);
    }

    /**
     * Update Announcement
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function postUpdate ($id) {
        $data = \Input::get('data');
        if (!$model = $this->AnnouncementRepository->findById($id)) {
            return \Response::json([
                'type' => 'error',
                'message' => 'Data not found'
            ]);
        }
        if (isset($data['files'])) unset($data['files']);
        $model->title_en = $data['title_en'];
        $model->title_chs = $data['title_chs'];
        $model->title_cht = $data['title_cht'];
        $model->content_en = $data['content_en'];
        $model->content_chs = $data['content_chs'];
        $model->content_cht = $data['content_cht'];
        $model->created_at = $data['created_at'];
        $model->save();

        \Cache::forget('announcement.new');

        return \Response::json([
            'type' => 'success',
            'message' => 'Announcement updated.'
        ]);
    }

    /**
     * Remove Announcement
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function remove ($id) {
        if (!$model = $this->AnnouncementRepository->findById($id)) {
            return \Response::json([
                'type' => 'error',
                'message' => 'Data not found'
            ]);
        }

        $model->delete();

        \Cache::forget('announcement.new');

        return \Response::json([
            'type' => 'success',
            'message' => 'Announcement removed.'
        ]);
    }
}
