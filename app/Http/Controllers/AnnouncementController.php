<?php

namespace App\Http\Controllers;

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
        parent::__construct();
        $this->AnnouncementRepository = $AnnouncementRepository;
        $this->middleware('member');
    }

    /**
     * Datatable List
     * @return [type] [description]
     */
    public function getList () {
        return $this->AnnouncementRepository->getList();
    }

    /**
     * Announcement List
     * @return html
     */
    public function getAll () {
        return view('front.announcement.list');
    }

    /**
     * Announcement Read Page
     * @param  integer $id
     * @return html
     */
    public function read ($lang, $id) {
        if (!$model = $this->AnnouncementRepository->findById($id)) {
            return redirect()->back()->with('flashMessage', [
                'class' => 'danger',
                'message' => \Lang::get('error.announcementNotFound')
            ]);
        }

        return view('front.announcement.read')->with('model', $model);
    }
}
