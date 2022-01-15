<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // 新規作成されたnote_idを取得して代入
        $note_id = $request->note_id;

        // データベースからノートの情報を取得して代入
        $notes = Note::all();

        // ダッシュボードを表示
        return view('dashboard', compact('note_id', 'notes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // フォームに入力された内容をデータベースへ登録
        $page = new Page;
        $form = $request->all();
        $page->fill($form)->save();

        // ダッシュボードを表示
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // データベースからノートの情報を取得して代入
        $notes = Note::all();

        // データベースからページの情報を取得して代入
        $contents = Page::find($id);

        // ダッシュボードを表示
        return view('dashboard', compact('notes', 'contents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // データベースからページ情報を取得して代入
        $page = Page::find($id);

        // ページの内容を更新
        $page->page_contents = $request->page_contents;
        $page->save();

        // 元の画面を表示
        return redirect()->route('page.show', compact('page'))->with('message', '更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
