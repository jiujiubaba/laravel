<?php namespace App\Http\Controllers\Backend;

use Controller, Request, Auth;
use App\Notice;

class NoticesController extends Controller
{
    /**
     * 公告中心首页
     *
     * @date   2015-10-10
     * @return [type]     [description]
     */
    public function index()
    {
        $notices = Notice::orderBy('created_at', 'desc')->paginate(10);
        // dd(count($notices));
        return view('backend.systems.notices', ['notices' => $notices]);
    }

    public function store()
    {
        if (!Request::has('title', 'content')) {
            return failure('参数错误');
        }

        $admin = Auth::user()->admin();

        $notice = Notice::saveData([
            'title'         => Request::input('title'),
            'content'       => Request::input('content'),
            'admin_id'      => $admin->id,
            'admin_name'    => $admin->name,
            'status'        => 1
        ]);
        if (!$notice) {
            return failure('添加失败');
        }

        return success('添加成功');
    }

    public function show($id)
    {
        if (!$id) {
            return failure('请选择公告');
        }

        $notice = Notice::find($id);

        return success(['notice' => $notice]);
    }

    public function edit($id)
    {
        $notice = Notice::find($id);
        if ($notice->delete()) {
            return success('删除成功');
        }
        return failure('删除失败');
    }

    public function update()
    {
        if (!Request::has('_id', 'title', 'content', 'status')) {
            return failure('参数错误');
        }
        $notice = Notice::find(Request::input('_id'));
        $notice->title = Request::input('title');
        $notice->content = Request::input('content');
        $notice->status = Request::input('status');
        if ($notice->save()) {
            return success('修改成功');
        }

        return failure('修改失败');
    }   
    
}
